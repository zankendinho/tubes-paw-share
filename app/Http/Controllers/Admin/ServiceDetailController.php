<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\SparePart;
use App\Models\ServiceDetail;
use Illuminate\Http\Request;

class ServiceDetailController extends Controller
{
    // Tampilkan halaman kelola spare parts untuk service
    public function index(Service $service)
    {
        $service->load('serviceDetails.sparePart', 'customer', 'device');
        $spareParts = SparePart::where('stok', '>', 0)->orderBy('nama_part', 'asc')->get();
        
        return view('admin.service-details.index', compact('service', 'spareParts'));
    }

    // Tambah spare part ke service
    public function store(Request $request, Service $service)
    {
        $request->validate([
            'spare_part_id' => 'required|exists:spare_parts,id',
            'qty' => 'required|integer|min:1',
        ]);

        $sparePart = SparePart::findOrFail($request->spare_part_id);

        // Cek stok
        if ($sparePart->stok < $request->qty) {
            return redirect()->back()
                ->with('error', 'Stok spare part tidak mencukupi! Stok tersedia: ' . $sparePart->stok);
        }

        // Hitung subtotal
        $hargaSatuan = $sparePart->harga_jual;
        $subtotal = $hargaSatuan * $request->qty;

        // Simpan service detail
        ServiceDetail::create([
            'service_id' => $service->id,
            'spare_part_id' => $request->spare_part_id,
            'qty' => $request->qty,
            'harga_satuan' => $hargaSatuan,
            'subtotal' => $subtotal,
        ]);

        // Kurangi stok spare part
        $sparePart->decrement('stok', $request->qty);

        // Update biaya service
        $totalBiayaSparepart = $service->serviceDetails()->sum('subtotal');
        $service->update([
            'biaya_sparepart' => $totalBiayaSparepart,
            'biaya_total' => $service->biaya_jasa + $totalBiayaSparepart,
        ]);

        return redirect()->route('admin.service-details.index', $service->id)
            ->with('success', 'Spare part berhasil ditambahkan!');
    }

    // Hapus spare part dari service
    public function destroy(Service $service, ServiceDetail $serviceDetail)
    {
        // Kembalikan stok spare part
        $serviceDetail->sparePart->increment('stok', $serviceDetail->qty);

        // Hapus service detail
        $serviceDetail->delete();

        // Update biaya service
        $totalBiayaSparepart = $service->serviceDetails()->sum('subtotal');
        $service->update([
            'biaya_sparepart' => $totalBiayaSparepart,
            'biaya_total' => $service->biaya_jasa + $totalBiayaSparepart,
        ]);

        return redirect()->route('admin.service-details.index', $service->id)
            ->with('success', 'Spare part berhasil dihapus dan stok dikembalikan!');
    }
}