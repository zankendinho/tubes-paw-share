<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    // Tampilkan daftar customer
    public function index()
    {
        // Hanya ambil customer yang punya user
$customers = Customer::whereHas('user')->with('user')->paginate(10);
        return view('admin.customers.index', compact('customers'));
    }

    // Tampilkan form tambah customer
    public function create()
    {
        return view('admin.customers.create');
    }

    // Simpan customer baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'telp' => 'required|string|max:15',
            'alamat' => 'nullable|string',
        ]);

        // Buat user dulu
        $user = User::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'customer',
            'telp' => $request->telp,
            'foto' => 'default.jpg',
            'status' => 'aktif',
        ]);

        // Buat customer
        Customer::create([
            'user_id' => $user->id,
            'nama' => $request->nama,
            'email' => $request->email,
            'telp' => $request->telp,
            'alamat' => $request->alamat,
            'tanggal_daftar' => now(),
        ]);

        return redirect()->route('admin.customers.index')
            ->with('success', 'Customer berhasil ditambahkan!');
    }

    // Tampilkan detail customer
    public function show(Customer $customer)
    {
        $customer->load('user', 'devices', 'services');
        return view('admin.customers.show', compact('customer'));
    }

    // Tampilkan form edit customer
    public function edit(Customer $customer)
    {
        return view('admin.customers.edit', compact('customer'));
    }

    // Update customer
    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $customer->user_id,
            'telp' => 'required|string|max:15',
            'alamat' => 'nullable|string',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        // Update user
        $customer->user->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'telp' => $request->telp,
            'status' => $request->status,
        ]);

        // Update customer
        $customer->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'telp' => $request->telp,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('admin.customers.index')
            ->with('success', 'Customer berhasil diupdate!');
    }

    // Hapus customer
    public function destroy(Customer $customer)
    {
        $customer->user->delete(); // Akan otomatis delete customer juga (cascade)
        
        return redirect()->route('admin.customers.index')
            ->with('success', 'Customer berhasil dihapus!');
    }
}