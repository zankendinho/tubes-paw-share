<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DeviceController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SparePartController;
use App\Http\Controllers\Customer\DashboardController as CustomerDashboardController;
use App\Http\Controllers\Admin\TechnicianController;
use App\Http\Controllers\Admin\ServiceDetailController;
use App\Http\Controllers\Customer\PaymentController as CustomerPaymentController;
use App\Http\Controllers\Admin\PaymentController as AdminPaymentController;
use App\Http\Controllers\Customer\DeviceController as CustomerDeviceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
}); 

// Routes untuk Admin (harus login sebagai admin)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('customers', CustomerController::class);
    Route::resource('devices', DeviceController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('technicians', TechnicianController::class);

     // Payment Verification
    Route::get('/payments', [AdminPaymentController::class, 'index'])->name('payments.index');
    Route::get('/payments/{payment}', [AdminPaymentController::class, 'show'])->name('payments.show');
    Route::post('/payments/{payment}/verify', [AdminPaymentController::class, 'verify'])->name('payments.verify');
    Route::post('/payments/{payment}/reject', [AdminPaymentController::class, 'reject'])->name('payments.reject');
    
    // service details
    Route::get('/services/{service}/details', [ServiceDetailController::class, 'index'])->name('service-details.index');
    Route::post('/services/{service}/details', [ServiceDetailController::class, 'store'])->name('service-details.store');
    Route::delete('/services/{service}/details/{serviceDetail}', [ServiceDetailController::class, 'destroy'])->name('service-details.destroy');
    
    // Spare Parts Routes (manual karena pakai strip di URL)
    Route::get('/spare-parts', [SparePartController::class, 'index'])->name('spare-parts.index');
    Route::get('/spare-parts/create', [SparePartController::class, 'create'])->name('spare-parts.create');
    Route::post('/spare-parts', [SparePartController::class, 'store'])->name('spare-parts.store');
    Route::get('/spare-parts/{sparePart}', [SparePartController::class, 'show'])->name('spare-parts.show');
    Route::get('/spare-parts/{sparePart}/edit', [SparePartController::class, 'edit'])->name('spare-parts.edit');
    Route::put('/spare-parts/{sparePart}', [SparePartController::class, 'update'])->name('spare-parts.update');
    Route::delete('/spare-parts/{sparePart}', [SparePartController::class, 'destroy'])->name('spare-parts.destroy');
    
    // Route AJAX untuk get devices by customer
    Route::get('/get-devices/{customerId}', [ServiceController::class, 'getDevices'])->name('get-devices');
});

// Routes untuk Customer (harus login sebagai customer)
    Route::middleware(['auth'])->prefix('customer')->name('customer.')->group(function () {
    Route::get('/dashboard', [CustomerDashboardController::class, 'index'])->name('dashboard');

    // Routes Servis Customer
    Route::get('/services', [App\Http\Controllers\Customer\ServiceController::class, 'index'])->name('services.index');
    Route::get('/services/create', [App\Http\Controllers\Customer\ServiceController::class, 'create'])->name('services.create'); // ← INI HARUS SEBELUM {service}
    Route::post('/services', [App\Http\Controllers\Customer\ServiceController::class, 'store'])->name('services.store');
    Route::get('/services/{service}', [App\Http\Controllers\Customer\ServiceController::class, 'show'])->name('services.show');
    
    // Routes Device Customer
    Route::get('/devices', [CustomerDeviceController::class, 'index'])->name('devices.index');
    Route::get('/devices/create', [CustomerDeviceController::class, 'create'])->name('devices.create'); 
    Route::post('/devices', [CustomerDeviceController::class, 'store'])->name('devices.store');
    Route::get('/devices/{device}', [CustomerDeviceController::class, 'show'])->name('devices.show');

    

    // Routes Payment Customer
    Route::get('/services/{service}/payment', [CustomerPaymentController::class, 'create'])->name('payments.create');
    Route::post('/services/{service}/payment', [CustomerPaymentController::class, 'store'])->name('payments.store');
    Route::get('/services/{service}/payment/detail', [CustomerPaymentController::class, 'show'])->name('payments.show');
});

require __DIR__.'/auth.php';