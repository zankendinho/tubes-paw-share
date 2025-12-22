<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    // Tampilkan daftar pembayaran yang perlu diverifikasi
    public function index(Request $request)
    {
        $query = Payment::with(['service.device', 'customer']);

        // Filter berdasarkan status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $payments = $query->orderBy('created_at', 'desc')->paginate(10);

        // Hitung statistik
        $pending = Payment::where('status', 'pending')->count();
        $verified = Payment::where('status', 'verified')->count();
        $rejected = Payment::where('status', 'rejected')->count();

        return view('admin.payments.index', compact('payments', 'pending', 'verified', 'rejected'));
    }

    // Tampilkan detail pembayaran
    public function show(Payment $payment)
    {
        $payment->load('service.device', 'customer', 'verifier');
        return view('admin.payments.show', compact('payment'));
    }

    // Verifikasi pembayaran (terima)
    public function verify(Payment $payment)
    {
        $payment->update([
            'status' => 'verified',
            'tanggal_verifikasi' => now(),
            'verified_by' => Auth::id(),
        ]);

        // Update status service jadi "diambil" (lunas)
        $payment->service->update([
            'status' => 'diambil',
        ]);

        return redirect()->route('admin.payments.index')
            ->with('success', 'Pembayaran berhasil diverifikasi! Status servis diubah menjadi "Diambil".');
    }

    // Tolak pembayaran
    public function reject(Request $request, Payment $payment)
    {
        $request->validate([
            'keterangan_reject' => 'required|string',
        ]);

        $payment->update([
            'status' => 'rejected',
            'keterangan' => $request->keterangan_reject,
            'tanggal_verifikasi' => now(),
            'verified_by' => Auth::id(),
        ]);

        return redirect()->route('admin.payments.index')
            ->with('success', 'Pembayaran ditolak. Customer dapat mengupload ulang bukti transfer.');
    }
}