<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; // Pastikan ini ada

class PaymentController extends Controller
{
    // Tampilkan form upload bukti bayar
    public function create(Service $service)
    {
        $customer = Auth::user()->customer;

        // Cek apakah servis ini milik customer yang login
        if ($service->customer_id != $customer->id) {
            abort(403, 'Unauthorized');
        }

        // Cek apakah servis sudah selesai
        if ($service->status != 'selesai') {
            return redirect()->route('customer.services.index')
                ->with('error', 'Servis belum selesai, tidak bisa melakukan pembayaran!');
        }

        // Cek apakah sudah pernah bayar dan verified
        if ($service->payment && $service->payment->status == 'verified') {
            return redirect()->route('customer.services.index')
                ->with('error', 'Servis ini sudah lunas!');
        }

        $service->load('device');

        return view('customer.payments.create', compact('service'));
    }

    // Simpan bukti bayar
    public function store(Request $request, Service $service)
    {
        $customer = Auth::user()->customer;

        // Validasi
        if ($service->customer_id != $customer->id) {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'jumlah_bayar' => 'required|numeric|min:0',
            'metode_pembayaran' => 'required|in:transfer_bank,cash,e-wallet',
            'bukti_transfer' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'keterangan' => 'nullable|string',
        ]);

        // Upload bukti transfer
        $fileName = null;
        if ($request->hasFile('bukti_transfer')) {
            $file = $request->file('bukti_transfer');
            $fileName = 'bukti-' . $service->kode_servis . '-' . time() . '.' . $file->getClientOriginalExtension();
    
            Storage::disk('public')->putFileAs('payments', $file, $fileName);
        }

        // Jika sudah ada payment sebelumnya (rejected), update saja
        if ($service->payment) {
            // Hapus file lama jika ada
            if ($service->payment->bukti_transfer) {
                // 🔥 PERBAIKAN 2: Menggunakan Storage::disk('public')->delete untuk menghapus file lama
                Storage::disk('public')->delete('payments/' . $service->payment->bukti_transfer);
            }

            $service->payment->update([
                'jumlah_bayar' => $request->jumlah_bayar,
                'bukti_transfer' => $fileName,
                'metode_pembayaran' => $request->metode_pembayaran,
                'status' => 'pending',
                'keterangan' => $request->keterangan,
                'tanggal_upload' => now(),
                'tanggal_verifikasi' => null,
                'verified_by' => null,
            ]);
        } else {
            // Buat payment baru
            Payment::create([
                'service_id' => $service->id,
                'customer_id' => $customer->id,
                'jumlah_bayar' => $request->jumlah_bayar,
                'bukti_transfer' => $fileName,
                'metode_pembayaran' => $request->metode_pembayaran,
                'status' => 'pending',
                'keterangan' => $request->keterangan,
                'tanggal_upload' => now(),
            ]);
        }

        return redirect()->route('customer.services.index')
            ->with('success', 'Bukti pembayaran berhasil diupload! Menunggu verifikasi admin.');
    }

    // Lihat detail pembayaran
    public function show(Service $service)
    {
        $customer = Auth::user()->customer;

        if ($service->customer_id != $customer->id) {
            abort(403, 'Unauthorized');
        }

        $service->load('device', 'payment.verifier');

        return view('customer.payments.show', compact('service'));
    }
}