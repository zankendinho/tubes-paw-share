<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Technician;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TechnicianController extends Controller
{
    // Tampilkan daftar technician
    public function index()
    {
        $technicians = Technician::with('user')->orderBy('created_at', 'desc')->paginate(10);
        
        // Hitung statistik
        $totalTechnicians = Technician::count();
        $available = Technician::where('status', 'tersedia')->count();
        $busy = Technician::where('status', 'sibuk')->count();
        
        return view('admin.technicians.index', compact('technicians', 'totalTechnicians', 'available', 'busy'));
    }

    // Tampilkan form tambah technician
    public function create()
    {
        return view('admin.technicians.create');
    }

    // Simpan technician baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'telp' => 'required|string|max:15',
            'spesialisasi' => 'required|string|max:100',
            'pengalaman' => 'required|integer|min:0',
        ]);

        // Buat user dulu
        $user = User::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
            'telp' => $request->telp,
            'foto' => 'default.jpg',
            'status' => 'aktif',
        ]);

        // Buat technician
        Technician::create([
            'user_id' => $user->id,
            'spesialisasi' => $request->spesialisasi,
            'pengalaman' => $request->pengalaman,
            'rating' => 0,
            'total_servis' => 0,
            'status' => 'tersedia',
        ]);

        return redirect()->route('admin.technicians.index')
            ->with('success', 'Teknisi berhasil ditambahkan!');
    }

    // Tampilkan detail technician
    public function show(Technician $technician)
    {
        $technician->load('user', 'services.customer', 'services.device');
        return view('admin.technicians.show', compact('technician'));
    }

    // Tampilkan form edit technician
    public function edit(Technician $technician)
    {
        return view('admin.technicians.edit', compact('technician'));
    }

    // Update technician
    public function update(Request $request, Technician $technician)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $technician->user_id,
            'telp' => 'required|string|max:15',
            'spesialisasi' => 'required|string|max:100',
            'pengalaman' => 'required|integer|min:0',
            'status' => 'required|in:tersedia,sibuk',
            'user_status' => 'required|in:aktif,nonaktif',
        ]);

        // Update user
        $technician->user->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'telp' => $request->telp,
            'status' => $request->user_status,
        ]);

        // Update technician
        $technician->update([
            'spesialisasi' => $request->spesialisasi,
            'pengalaman' => $request->pengalaman,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.technicians.index')
            ->with('success', 'Teknisi berhasil diupdate!');
    }

    // Hapus technician
    public function destroy(Technician $technician)
    {
        // Cek apakah teknisi masih punya servis aktif
        $activeServices = $technician->services()->whereIn('status', ['pending', 'proses'])->count();
        
        if ($activeServices > 0) {
            return redirect()->route('admin.technicians.index')
                ->with('error', 'Teknisi tidak bisa dihapus karena masih ada servis aktif!');
        }

        $technician->user->delete(); // Akan otomatis delete technician juga (cascade)
        
        return redirect()->route('admin.technicians.index')
            ->with('success', 'Teknisi berhasil dihapus!');
    }
}