<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DeviceController extends Controller
{
    // Tampilkan daftar perangkat customer
    public function index()
    {
        $customer = Auth::user()->customer;

        if (!$customer) {
            return redirect()->route('customer.dashboard')
                ->with('error', 'Data customer tidak ditemukan!');
        }

        $devices = Device::where('customer_id', $customer->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('customer.devices.index', compact('devices'));
    }

    // Tampilkan detail perangkat
    public function show(Device $device)
    {
        $customer = Auth::user()->customer;

        // Cek apakah device ini milik customer yang login
        if ($device->customer_id != $customer->id) {
            abort(403, 'Unauthorized');
        }

        $device->load('services.technician.user');

        return view('customer.devices.show', compact('device'));
    }

    // Form tambah device baru
    public function create()
    {
        $customer = Auth::user()->customer;

        if (!$customer) {
            return redirect()->route('customer.dashboard')
                ->with('error', 'Data customer tidak ditemukan!');
        }

        $kategoriOptions = ['TV', 'AC', 'Laptop', 'PC', 'Kulkas', 'Mesin Cuci', 'Lainnya'];

        return view('customer.devices.create', compact('kategoriOptions'));
    }

    // Simpan device baru
    public function store(Request $request)
    {
        $customer = Auth::user()->customer;

        if (!$customer) {
            return redirect()->route('customer.dashboard')
                ->with('error', 'Data customer tidak ditemukan!');
        }

        // Validasi input
        $validated = $request->validate([
            'kategori' => 'required|in:TV,AC,Laptop,PC,Kulkas,Mesin Cuci,Lainnya',
            'merk' => 'required|string|max:50',
            'model' => 'nullable|string|max:50',
            'serial_number' => 'nullable|string|max:100',
            'tahun_beli' => 'nullable|integer|min:1900|max:' . (date('Y') + 1),
            'kondisi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Max 2MB
        ], [
            'kategori.required' => 'Kategori device harus dipilih',
            'merk.required' => 'Merk device harus diisi',
            'foto.image' => 'File harus berupa gambar',
            'foto.mimes' => 'Format gambar harus JPG, JPEG, atau PNG',
            'foto.max' => 'Ukuran gambar maksimal 2MB',
        ]);

        // Handle upload foto
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            
            // Generate nama file unik
            $fileName = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $file->getClientOriginalName());
            
            // Simpan di storage/app/public/devices
            $fotoPath = $file->storeAs('devices', $fileName, 'public');
        }

        // Simpan device
        $device = Device::create([
            'customer_id' => $customer->id,
            'kategori' => $validated['kategori'],
            'merk' => $validated['merk'],
            'model' => $validated['model'],
            'serial_number' => $validated['serial_number'],
            'tahun_beli' => $validated['tahun_beli'],
            'kondisi' => $validated['kondisi'],
            'foto' => $fotoPath, // Simpan path foto
        ]);

        return redirect()->route('customer.devices.show', $device->id)
            ->with('success', 'Device berhasil ditambahkan!');
    }
}