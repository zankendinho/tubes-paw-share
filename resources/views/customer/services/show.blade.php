<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Servis') }} - {{ $service->kode_servis }}
            </h2>
            <a href="{{ route('customer.services.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-semibold rounded-lg transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Header Card with Gradient -->
            <div class="bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 rounded-2xl shadow-xl overflow-hidden">
                <div class="px-8 py-8">
                    <div class="flex flex-wrap justify-between items-start gap-4">
                        <div>
                            <p class="text-indigo-100 text-sm mb-2">Kode Servis</p>
                            <h1 class="text-4xl font-bold text-white mb-2">{{ $service->kode_servis }}</h1>
                            <p class="text-indigo-100">
                                <svg class="inline w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                Diajukan: {{ $service->tanggal_masuk->format('d M Y') }}
                            </p>
                        </div>
                        <div class="flex gap-3">
                            <span class="px-5 py-3 text-base font-bold rounded-xl shadow-lg
                                @if($service->status == 'pending') bg-yellow-500 text-white
                                @elseif($service->status == 'proses') bg-purple-500 text-white
                                @elseif($service->status == 'selesai') bg-green-500 text-white
                                @elseif($service->status == 'diambil') bg-indigo-500 text-white
                                @else bg-red-500 text-white
                                @endif">
                                {{ ucfirst($service->status) }}
                            </span>
                            @if($service->prioritas == 'urgent')
                                <span class="px-5 py-3 text-base font-bold rounded-xl bg-red-600 text-white shadow-lg">
                                    🔥 Urgent
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- 3 Column Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <!-- Status Servis -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-500 to-cyan-500 px-6 py-4">
                        <h3 class="text-lg font-semibold text-white">Status Servis</h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div>
                            <p class="text-xs text-gray-500 mb-1">Status Saat Ini</p>
                            <span class="px-3 py-1 inline-flex text-sm font-bold rounded-full
                                @if($service->status == 'pending') bg-yellow-100 text-yellow-800
                                @elseif($service->status == 'proses') bg-purple-100 text-purple-800
                                @elseif($service->status == 'selesai') bg-green-100 text-green-800
                                @elseif($service->status == 'diambil') bg-indigo-100 text-indigo-800
                                @else bg-red-100 text-red-800
                                @endif">
                                {{ ucfirst($service->status) }}
                            </span>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 mb-1">Prioritas</p>
                            <span class="px-3 py-1 inline-flex text-sm font-bold rounded-full
                                @if($service->prioritas == 'urgent') bg-red-100 text-red-800
                                @else bg-gray-100 text-gray-800
                                @endif">
                                {{ ucfirst($service->prioritas) }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Info Perangkat -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-green-500 to-emerald-500 px-6 py-4">
                        <h3 class="text-lg font-semibold text-white">Perangkat</h3>
                    </div>
                    <div class="p-6 space-y-3">
                        <div>
                            <p class="text-xs text-gray-500 mb-1">Kategori</p>
                            <p class="font-bold text-gray-900">{{ $service->device->kategori }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 mb-1">Merk & Model</p>
                            <p class="font-semibold text-gray-900">{{ $service->device->merk }} {{ $service->device->model }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 mb-1">Serial Number</p>
                            <p class="font-mono text-sm text-gray-900">{{ $service->device->serial_number ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Teknisi -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-orange-500 to-red-500 px-6 py-4">
                        <h3 class="text-lg font-semibold text-white">Teknisi</h3>
                    </div>
                    <div class="p-6 space-y-3">
                        <div>
                            <p class="text-xs text-gray-500 mb-1">Nama Teknisi</p>
                            <p class="font-bold text-gray-900">{{ $service->technician ? $service->technician->user->nama : 'Belum ditentukan' }}</p>
                        </div>
                        @if($service->technician)
                            <div>
                                <p class="text-xs text-gray-500 mb-1">Spesialisasi</p>
                                <p class="font-semibold text-gray-900">{{ $service->technician->spesialisasi }}</p>
                            </div>
                        @endif
                    </div>
                </div>

            </div>

            <!-- Detail Masalah -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-purple-500 to-pink-500 px-6 py-4">
                    <h3 class="text-lg font-semibold text-white">Detail Masalah</h3>
                </div>
                <div class="p-6 space-y-4">
                    <div class="bg-gray-50 rounded-lg p-4">
                        <p class="text-xs text-gray-500 font-medium mb-2">Keluhan Customer</p>
                        <p class="text-gray-900">{{ $service->keluhan }}</p>
                    </div>
                    
                    @if($service->diagnosa)
                        <div class="bg-blue-50 rounded-lg p-4">
                            <p class="text-xs text-blue-600 font-medium mb-2">Diagnosa Teknisi</p>
                            <p class="text-gray-900">{{ $service->diagnosa }}</p>
                        </div>
                    @endif
                    
                    @if($service->tindakan)
                        <div class="bg-green-50 rounded-lg p-4">
                            <p class="text-xs text-green-600 font-medium mb-2">Tindakan yang Dilakukan</p>
                            <p class="text-gray-900">{{ $service->tindakan }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Spare Parts -->
            @if($service->serviceDetails->count() > 0)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-teal-500 to-cyan-500 px-6 py-4">
                        <h3 class="text-lg font-semibold text-white">Spare Parts yang Digunakan</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase">Nama Part</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-600 uppercase">Qty</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-600 uppercase">Harga</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-600 uppercase">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($service->serviceDetails as $detail)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 text-sm text-gray-900">{{ $detail->sparePart->nama_part }}</td>
                                        <td class="px-6 py-4 text-sm text-center text-gray-900">{{ $detail->qty }}</td>
                                        <td class="px-6 py-4 text-sm text-right text-gray-900">Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 text-sm text-right font-semibold text-gray-900">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

            <!-- Rincian Biaya & Pembayaran -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-indigo-500 to-blue-500 px-6 py-4">
                    <h3 class="text-lg font-semibold text-white">Rincian Biaya & Pembayaran</h3>
                </div>
                <div class="p-6">
                    <div class="bg-gray-50 rounded-xl p-6 space-y-4">
                        <div class="flex justify-between items-center pb-3 border-b border-gray-200">
                            <span class="text-gray-700">Biaya Jasa:</span>
                            @if($service->biaya_jasa > 0)
                                <span class="font-semibold text-gray-900">Rp {{ number_format($service->biaya_jasa, 0, ',', '.') }}</span>
                            @else
                                <span class="text-sm font-semibold text-gray-500 italic">Dalam Estimasi</span>
                            @endif
                        </div>
                        <div class="flex justify-between items-center pb-3 border-b border-gray-200">
                            <span class="text-gray-700">Biaya Spare Part:</span>
                            @if($service->biaya_sparepart > 0)
                                <span class="font-semibold text-gray-900">Rp {{ number_format($service->biaya_sparepart, 0, ',', '.') }}</span>
                            @else
                                <span class="text-sm font-semibold text-gray-500 italic">Dalam Estimasi</span>
                            @endif
                        </div>
                        <div class="flex justify-between items-center pt-2">
                            <span class="text-xl font-bold text-gray-900">Total Biaya:</span>
                            @if($service->biaya_total > 0)
                                <span class="text-3xl font-bold text-blue-600">Rp {{ number_format($service->biaya_total, 0, ',', '.') }}</span>
                            @else
                                <span class="text-lg font-bold text-gray-500 italic">Dalam Estimasi</span>
                            @endif
                        </div>
                    </div>

                    @if($service->status == 'selesai' && $service->biaya_total > 0 && (!$service->payment || $service->payment->status != 'verified'))
                        <div class="pt-6">
                            <a href="{{ route('customer.payments.create', $service->id) }}" 
                                class="w-full inline-flex items-center justify-center px-6 py-4 bg-gradient-to-r from-green-500 to-emerald-500 hover:from-green-600 hover:to-emerald-600 text-white font-bold rounded-xl transition shadow-xl text-lg">
                                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                </svg>
                                Bayar Sekarang
                            </a>
                        </div>
                    @endif

                    @if($service->payment)
                        <div class="pt-6 border-t border-gray-200 mt-6">
                            <p class="text-sm font-semibold text-gray-700 mb-3">Status Pembayaran:</p>
                            @if($service->payment->status == 'pending')
                                <div class="bg-yellow-50 border-l-4 border-yellow-500 rounded-lg p-4">
                                    <div class="flex items-center">
                                        <svg class="w-6 h-6 text-yellow-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <span class="font-semibold text-yellow-800">Menunggu Verifikasi Admin</span>
                                    </div>
                                </div>
                            @elseif($service->payment->status == 'verified')
                                <div class="bg-green-50 border-l-4 border-green-500 rounded-lg p-4">
                                    <div class="flex items-center">
                                        <svg class="w-6 h-6 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        <span class="font-semibold text-green-800">Lunas - Terverifikasi</span>
                                    </div>
                                </div>
                            @elseif($service->payment->status == 'rejected')
                                <div class="bg-red-50 border-l-4 border-red-500 rounded-lg p-4">
                                    <div class="flex items-center">
                                        <svg class="w-6 h-6 text-red-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                        <span class="font-semibold text-red-800">Ditolak - Silakan Upload Ulang</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>

            <!-- Timeline -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-gray-700 to-gray-900 px-6 py-4">
                    <h3 class="text-lg font-semibold text-white">Timeline Servis</h3>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div class="flex items-center">
                            <div class="bg-blue-100 p-2 rounded-lg">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div class="ml-4 flex-1">
                                <p class="text-sm text-gray-600">Tanggal Masuk</p>
                                <p class="font-semibold text-gray-900">{{ $service->tanggal_masuk->format('d M Y') }}</p>
                            </div>
                        </div>
                        
                        @if($service->tanggal_mulai)
                            <div class="flex items-center">
                                <div class="bg-purple-100 p-2 rounded-lg">
                                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div class="ml-4 flex-1">
                                    <p class="text-sm text-gray-600">Tanggal Mulai Pengerjaan</p>
                                    <p class="font-semibold text-gray-900">{{ $service->tanggal_mulai->format('d M Y') }}</p>
                                </div>
                            </div>
                        @endif

                        @if($service->tanggal_selesai)
                            <div class="flex items-center">
                                <div class="bg-green-100 p-2 rounded-lg">
                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </div>
                                <div class="ml-4 flex-1">
                                    <p class="text-sm text-gray-600">Tanggal Selesai</p>
                                    <p class="font-semibold text-gray-900">{{ $service->tanggal_selesai->format('d M Y') }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>