<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Device;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil data customer yang sedang login
        $customer = Auth::user()->customer;

        if (!$customer) {
            return redirect()->route('customer.dashboard')
                ->with('error', 'Data customer tidak ditemukan!');
        }

        // Hitung statistik
        $totalDevices = Device::where('customer_id', $customer->id)->count();
        $totalServices = Service::where('customer_id', $customer->id)->count();
        
        // Count berdasarkan status (pakai nama variabel yang sama dengan view)
        $servicePending = Service::where('customer_id', $customer->id)
            ->where('status', 'pending')
            ->count();
        $serviceProses = Service::where('customer_id', $customer->id)
            ->where('status', 'proses')
            ->count();
        $serviceSelesai = Service::where('customer_id', $customer->id)
            ->where('status', 'selesai')
            ->count();
        $serviceDiambil = Service::where('customer_id', $customer->id)
            ->where('status', 'diambil')
            ->count();
        $serviceBatal = Service::where('customer_id', $customer->id)
            ->where('status', 'batal')
            ->count();

        // Ambil servis terbaru (5 terakhir)
        $recentServices = Service::where('customer_id', $customer->id)
            ->with(['device', 'technician.user'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Ambil device customer
        $devices = Device::where('customer_id', $customer->id)->get();

        return view('customer.dashboard', compact(
            'customer',
            'totalDevices',
            'totalServices',
            'servicePending',
            'serviceProses',
            'serviceSelesai',
            'serviceDiambil',
            'serviceBatal',
            'recentServices',
            'devices'
        ));
    }
}