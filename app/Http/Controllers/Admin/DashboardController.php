<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Service;
use App\Models\SparePart;
use App\Models\Technician;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung statistik
        $totalCustomers = Customer::count();
        $totalServices = Service::count();
        
        // Count berdasarkan status
        $servicePending = Service::where('status', 'pending')->count();
        $serviceProses = Service::where('status', 'proses')->count();
        $serviceSelesai = Service::where('status', 'selesai')->count();
        $serviceDiambil = Service::where('status', 'diambil')->count();
        $serviceBatal = Service::where('status', 'batal')->count();
        
        $totalTechnicians = Technician::count();
        $totalSpareParts = SparePart::count();
        $sparePartsLowStock = SparePart::whereColumn('stok', '<=', 'stok_minimum')->count();

        // Ambil servis terbaru (10 terakhir)
        $recentServices = Service::with(['customer', 'device', 'technician.user'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return view('admin.dashboard', compact(
            'totalCustomers',
            'totalServices',
            'servicePending',
            'serviceProses',
            'serviceSelesai',
            'serviceDiambil',
            'serviceBatal',
            'totalTechnicians',
            'totalSpareParts',
            'sparePartsLowStock',
            'recentServices'
        ));
    }
}