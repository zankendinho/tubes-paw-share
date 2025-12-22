<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    // Tampilkan daftar servis customer
    public function index(Request $request)
    {
        $customer = Auth::user()->customer;

        if (!$customer) {
            return redirect()->route('customer.dashboard')
                ->with('error', 'Data customer tidak ditemukan!');
        }

        $query = Service::where('customer_id', $customer->id)
            ->with(['device', 'technician.user', 'payment']);

        // Filter berdasarkan status jika ada
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $services = $query->orderBy('created_at', 'desc')->paginate(10);

        // Hitung statistik
        $totalServices = Service::where('customer_id', $customer->id)->count();
        $pending = Service::where('customer_id', $customer->id)->where('status', 'pending')->count();
        $proses = Service::where('customer_id', $customer->id)->where('status', 'proses')->count();
        $selesai = Service::where('customer_id', $customer->id)->where('status', 'selesai')->count();
        $belumBayar = Service::where('customer_id', $customer->id)
            ->where('status', 'selesai')
            ->whereDoesntHave('payment', function($q) {
                $q->where('status', 'verified');
            })
            ->count();

        return view('customer.services.index', compact('services', 'totalServices', 'pending', 'proses', 'selesai', 'belumBayar'));
    }

    // Tampilkan detail servis
    public function show(Service $service)
    {
        $customer = Auth::user()->customer;

        // Cek apakah servis ini milik customer yang login
        if ($service->customer_id != $customer->id) {
            abort(403, 'Unauthorized');
        }

        $service->load('device', 'technician.user', 'serviceDetails.sparePart', 'payment');

        return view('customer.services.show', compact('service'));
    }
    // Form ajukan servis baru
    public function create()
    {
        $customer = Auth::user()->customer;

        if (!$customer) {
            return redirect()->route('customer.dashboard')
                ->with('error', 'Data customer tidak ditemukan!');
        }

        // Ambil devices milik customer ini
        $devices = Device::where('customer_id', $customer->id)->get();

        // Jika customer belum punya device, redirect ke halaman tambah device
        if ($devices->isEmpty()) {
            return redirect()->route('customer.devices.index')
                ->with('info', 'Anda belum memiliki device terdaftar. Silakan tambahkan device terlebih dahulu.');
        }

        return view('customer.services.create', compact('devices'));
    }

    // Simpan pengajuan servis baru
    public function store(Request $request)
    {
        $customer = Auth::user()->customer;

        if (!$customer) {
            return redirect()->route('customer.dashboard')
                ->with('error', 'Data customer tidak ditemukan!');
        }

        // Validasi input
        $validated = $request->validate([
            'device_id' => 'required|exists:devices,id',
            'keluhan' => 'required|string|min:10',
            'prioritas' => 'required|in:normal,urgent',
        ], [
            'device_id.required' => 'Pilih device yang akan diservis',
            'device_id.exists' => 'Device tidak valid',
            'keluhan.required' => 'Keluhan harus diisi',
            'keluhan.min' => 'Keluhan minimal 10 karakter',
            'prioritas.required' => 'Pilih prioritas servis',
        ]);

        // Cek apakah device milik customer ini
        $device = Device::where('id', $validated['device_id'])
            ->where('customer_id', $customer->id)
            ->first();

        if (!$device) {
            return back()->with('error', 'Device tidak ditemukan atau bukan milik Anda!')->withInput();
        }

        DB::beginTransaction();
        try {
            // Generate kode servis unik
            $kodeServis = $this->generateKodeServis();

            // Buat service baru
            $service = Service::create([
                'kode_servis' => $kodeServis,
                'customer_id' => $customer->id,
                'device_id' => $validated['device_id'],
                'keluhan' => $validated['keluhan'],
                'tanggal_masuk' => now(),
                'status' => 'pending',
                'prioritas' => $validated['prioritas'],
            ]);

            DB::commit();

            return redirect()->route('customer.services.show', $service->id)
                ->with('success', 'Pengajuan servis berhasil! Kode servis Anda: ' . $kodeServis);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    // Generate kode servis unik
    private function generateKodeServis()
{
    // 1. Tentukan prefix format simpel
    $prefix = 'SRV-'; 
    
    // 2. Cari servis terakhir yang HANYA menggunakan format simpel (SRV-...)
    // Kita filter menggunakan 'LIKE SRV-%' agar kode yang panjang (SRV2025...) tidak ikut terambil
    $lastService = Service::where('kode_servis', 'LIKE', $prefix . '%')
        ->orderByRaw('LENGTH(kode_servis) desc') // Jaga-jaga agar urutan digit (10 vs 2) benar
        ->orderBy('kode_servis', 'desc')
        ->first();

    if ($lastService) {
        // 3. Ambil angka setelah prefix 'SRV-' (mulai dari index ke-4)
        // Contoh: SRV-002 -> diambil '002' -> jadi integer 2
        $lastNumber = (int) substr($lastService->kode_servis, strlen($prefix));
        $newNumber = $lastNumber + 1;
    } else {
        // Jika belum ada format simpel sama sekali, mulai dari 1
        $newNumber = 1;
    }

    // 4. Format output: SRV-001
    return $prefix . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
}
}