<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Customer;
use App\Models\Device;
use App\Models\Technician;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    // Tampilkan daftar service
   public function index(Request $request)
{
    $query = Service::with(['customer', 'device', 'technician.user']);
    
    // Filter berdasarkan status jika ada
    if ($request->has('status') && $request->status != '') {
        $query->where('status', $request->status);
    }
    
    $services = $query->orderBy('created_at', 'desc')->paginate(10);
    
    return view('admin.services.index', compact('services'));
}

    // Tampilkan form tambah service
    public function create()
    {
        $customers = Customer::orderBy('nama', 'asc')->get();
        $technicians = Technician::with('user')->get();
        
        return view('admin.services.create', compact('customers', 'technicians'));
    }

    // Ambil devices berdasarkan customer (AJAX)
    public function getDevices($customerId)
    {
        $devices = Device::where('customer_id', $customerId)->get();
        return response()->json($devices);
    }

    // Simpan service baru
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'device_id' => 'required|exists:devices,id',
            'keluhan' => 'required|string',
            'tanggal_masuk' => 'required|date',
            'prioritas' => 'required|in:normal,urgent',
            'estimasi_biaya' => 'nullable|numeric|min:0',
        ]);

        // Generate kode servis otomatis
        $lastService = Service::orderBy('id', 'desc')->first();
        $nextNumber = $lastService ? intval(substr($lastService->kode_servis, 4)) + 1 : 1;
        $kodeServis = 'SRV-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        Service::create([
            'kode_servis' => $kodeServis,
            'customer_id' => $request->customer_id,
            'device_id' => $request->device_id,
            'technician_id' => $request->technician_id,
            'keluhan' => $request->keluhan,
            'tanggal_masuk' => $request->tanggal_masuk,
            'prioritas' => $request->prioritas,
            'estimasi_biaya' => $request->estimasi_biaya ?? 0,
            'status' => 'pending',
        ]);

        return redirect()->route('admin.services.index')
            ->with('success', 'Service berhasil ditambahkan dengan kode: ' . $kodeServis);
    }

    // Tampilkan detail service
    public function show(Service $service)
    {
        $service->load('customer', 'device', 'technician.user', 'serviceDetails.sparePart');
        return view('admin.services.show', compact('service'));
    }

    // Tampilkan form edit service
    public function edit(Service $service)
    {
        $customers = Customer::orderBy('nama', 'asc')->get();
        $devices = Device::where('customer_id', $service->customer_id)->get();
        $technicians = Technician::with('user')->get();
        
        return view('admin.services.edit', compact('service', 'customers', 'devices', 'technicians'));
    }

    // Update service
    public function update(Request $request, Service $service)
{
    $request->validate([
        'customer_id' => 'required|exists:customers,id',
        'device_id' => 'required|exists:devices,id',
        'keluhan' => 'required|string',
        'diagnosa' => 'nullable|string',
        'tindakan' => 'nullable|string',
        'tanggal_masuk' => 'required|date',
        'tanggal_mulai' => 'nullable|date',
        'tanggal_estimasi_selesai' => 'nullable|date',
        'tanggal_selesai' => 'nullable|date',
        'estimasi_biaya' => 'nullable|numeric|min:0',
        'biaya_jasa' => 'nullable|numeric|min:0',
        'status' => 'required|in:pending,proses,selesai,diambil,batal',
        'prioritas' => 'required|in:normal,urgent',
        'catatan' => 'nullable|string',
        'technician_id' => 'nullable|exists:technicians,id', // Tambah validasi ini
    ]);

    // Ambil semua data request
    $data = $request->all();
    
    // Convert empty string ke null untuk technician_id
    if (empty($data['technician_id'])) {
        $data['technician_id'] = null;
    }

    $service->update($data);

    // Hitung biaya total
    $biayaTotal = ($request->biaya_jasa ?? 0) + $service->biaya_sparepart;
    $service->update(['biaya_total' => $biayaTotal]);

    return redirect()->route('admin.services.index')
        ->with('success', 'Service berhasil diupdate!');
}

    // Hapus service
    public function destroy(Service $service)
    {
        $service->delete();
        
        return redirect()->route('admin.services.index')
            ->with('success', 'Service berhasil dihapus!');
    }
}