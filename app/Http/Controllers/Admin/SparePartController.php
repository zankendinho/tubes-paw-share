<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SparePart;
use Illuminate\Http\Request;

class SparePartController extends Controller
{
    // Tampilkan daftar spare parts
    public function index()
    {
        $spareParts = SparePart::orderBy('nama_part', 'asc')->paginate(10);
        
        // Hitung statistik
        $totalParts = SparePart::count();
        $lowStock = SparePart::whereColumn('stok', '<=', 'stok_minimum')->count();
        $outOfStock = SparePart::where('stok', 0)->count();
        
        return view('admin.spare-parts.index', compact('spareParts', 'totalParts', 'lowStock', 'outOfStock'));
    }

    // Tampilkan form tambah spare part
    public function create()
    {
        return view('admin.spare-parts.create');
    }

    // Simpan spare part baru
    public function store(Request $request)
    {
        $request->validate([
            'kode_part' => 'required|string|max:50|unique:spare_parts,kode_part',
            'nama_part' => 'required|string|max:100',
            'kategori' => 'nullable|string|max:50',
            'stok' => 'required|integer|min:0',
            'stok_minimum' => 'required|integer|min:0',
            'harga_beli' => 'nullable|numeric|min:0',
            'harga_jual' => 'nullable|numeric|min:0',
            'supplier' => 'nullable|string|max:100',
            'keterangan' => 'nullable|string',
        ]);

        SparePart::create($request->all());

        return redirect()->route('admin.spare-parts.index')
            ->with('success', 'Spare part berhasil ditambahkan!');
    }

    // Tampilkan detail spare part
    public function show(SparePart $sparePart)
    {
        $sparePart->load('serviceDetails.service.customer');
        return view('admin.spare-parts.show', compact('sparePart'));
    }

    // Tampilkan form edit spare part
    public function edit(SparePart $sparePart)
    {
        return view('admin.spare-parts.edit', compact('sparePart'));
    }

    // Update spare part
    public function update(Request $request, SparePart $sparePart)
    {
        $request->validate([
            'kode_part' => 'required|string|max:50|unique:spare_parts,kode_part,' . $sparePart->id,
            'nama_part' => 'required|string|max:100',
            'kategori' => 'nullable|string|max:50',
            'stok' => 'required|integer|min:0',
            'stok_minimum' => 'required|integer|min:0',
            'harga_beli' => 'nullable|numeric|min:0',
            'harga_jual' => 'nullable|numeric|min:0',
            'supplier' => 'nullable|string|max:100',
            'keterangan' => 'nullable|string',
        ]);

        $sparePart->update($request->all());

        return redirect()->route('admin.spare-parts.index')
            ->with('success', 'Spare part berhasil diupdate!');
    }

    // Hapus spare part
    public function destroy(SparePart $sparePart)
    {
        // Cek apakah spare part sudah digunakan di service
        if ($sparePart->serviceDetails()->count() > 0) {
            return redirect()->route('admin.spare-parts.index')
                ->with('error', 'Spare part tidak bisa dihapus karena sudah digunakan di servis!');
        }

        $sparePart->delete();
        
        return redirect()->route('admin.spare-parts.index')
            ->with('success', 'Spare part berhasil dihapus!');
    }
}