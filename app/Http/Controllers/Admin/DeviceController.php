<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Device;
use App\Models\Customer;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    // Tampilkan daftar device
    public function index()
    {
        $devices = Device::with('customer')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.devices.index', compact('devices'));
    }

    // Tampilkan form tambah device
    public function create()
    {
        $customers = Customer::orderBy('nama', 'asc')->get();
        return view('admin.devices.create', compact('customers'));
    }

    // Simpan device baru
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'kategori' => 'required|in:TV,AC,Laptop,PC,Kulkas,Mesin Cuci,Lainnya',
            'merk' => 'required|string|max:50',
            'model' => 'nullable|string|max:50',
            'serial_number' => 'nullable|string|max:100',
            'tahun_beli' => 'nullable|integer|min:1900|max:' . date('Y'),
            'kondisi' => 'nullable|string',
        ]);

        Device::create($request->all());

        return redirect()->route('admin.devices.index')
            ->with('success', 'Device berhasil ditambahkan!');
    }

    // Tampilkan detail device
    public function show(Device $device)
    {
        $device->load('customer', 'services.technician.user');
        return view('admin.devices.show', compact('device'));
    }

    // Tampilkan form edit device
    public function edit(Device $device)
    {
        $customers = Customer::orderBy('nama', 'asc')->get();
        return view('admin.devices.edit', compact('device', 'customers'));
    }

    // Update device
    public function update(Request $request, Device $device)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'kategori' => 'required|in:TV,AC,Laptop,PC,Kulkas,Mesin Cuci,Lainnya',
            'merk' => 'required|string|max:50',
            'model' => 'nullable|string|max:50',
            'serial_number' => 'nullable|string|max:100',
            'tahun_beli' => 'nullable|integer|min:1900|max:' . date('Y'),
            'kondisi' => 'nullable|string',
        ]);

        $device->update($request->all());

        return redirect()->route('admin.devices.index')
            ->with('success', 'Device berhasil diupdate!');
    }

    // Hapus device
    public function destroy(Device $device)
    {
        $device->delete();
        
        return redirect()->route('admin.devices.index')
            ->with('success', 'Device berhasil dihapus!');
    }
}