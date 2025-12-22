<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Servis Saya') }}
            </h2>
            <a href="{{ route('customer.services.create') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold rounded-lg hover:from-indigo-700 hover:to-purple-700 transition shadow-lg">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Ajukan Servis Baru
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Stats Overview -->
            <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-8">
                <!-- Total -->
                <div class="bg-gradient-to-br from-blue-500 to-cyan-500 rounded-xl p-4 shadow-lg text-white">
                    <p class="text-xs font-medium opacity-90 mb-1">Total Servis</p>
                    <p class="text-3xl font-bold">{{ $totalServices }}</p>
                </div>
                
                <!-- Pending -->
                <div class="bg-white rounded-xl p-4 shadow-md border-l-4 border-yellow-500">
                    <p class="text-xs text-gray-600 font-medium mb-1">Menunggu</p>
                    <p class="text-3xl font-bold text-yellow-600">{{ $pending }}</p>
                </div>

                <!-- Proses -->
                <div class="bg-white rounded-xl p-4 shadow-md border-l-4 border-purple-500">
                    <p class="text-xs text-gray-600 font-medium mb-1">Proses</p>
                    <p class="text-3xl font-bold text-purple-600">{{ $proses }}</p>
                </div>

                <!-- Selesai -->
                <div class="bg-white rounded-xl p-4 shadow-md border-l-4 border-green-500">
                    <p class="text-xs text-gray-600 font-medium mb-1">Selesai</p>
                    <p class="text-3xl font-bold text-green-600">{{ $selesai }}</p>
                </div>

                <!-- Belum Bayar -->
                <div class="bg-white rounded-xl p-4 shadow-md border-l-4 border-red-500">
                    <p class="text-xs text-gray-600 font-medium mb-1">Belum Bayar</p>
                    <p class="text-3xl font-bold text-red-600">{{ $belumBayar }}</p>
                </div>
            </div>

            <!-- Filter -->
            <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
                <form method="GET" action="{{ route('customer.services.index') }}" class="flex flex-wrap gap-4 items-end">
                    <div class="flex-1 min-w-[200px]">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Filter Status</label>
                        <select name="status" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Semua Status</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu</option>
                            <option value="proses" {{ request('status') == 'proses' ? 'selected' : '' }}>Dalam Proses</option>
                            <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            <option value="diambil" {{ request('status') == 'diambil' ? 'selected' : '' }}>Diambil</option>
                            <option value="batal" {{ request('status') == 'batal' ? 'selected' : '' }}>Batal</option>
                        </select>
                    </div>
                    <div>
                        <button type="submit" class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg transition">
                            Filter
                        </button>
                    </div>
                    @if(request('status'))
                        <div>
                            <a href="{{ route('customer.services.index') }}" class="px-6 py-2 bg-gray-300 hover:bg-gray-400 text-gray-700 font-medium rounded-lg transition">
                                Reset
                            </a>
                        </div>
                    @endif
                </form>
            </div>

            <!-- Services List -->
            @if($services->count() > 0)
                <div class="space-y-4">
                    @foreach($services as $service)
                        <div class="bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border-l-4 
                            @if($service->status == 'pending') border-yellow-500 
                            @elseif($service->status == 'proses') border-purple-500 
                            @elseif($service->status == 'selesai') border-green-500 
                            @elseif($service->status == 'diambil') border-indigo-500
                            @else border-red-500 
                            @endif">
                            <div class="p-6">
                                <!-- Header -->
                                <div class="flex flex-wrap justify-between items-start gap-4 mb-4">
                                    <div>
                                        <h3 class="text-xl font-bold text-gray-900 mb-1">{{ $service->kode_servis }}</h3>
                                        <p class="text-sm text-gray-600">
                                            <svg class="inline w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                            {{ $service->tanggal_masuk->format('d M Y') }}
                                        </p>
                                    </div>
                                    <div class="flex gap-2">
                                        <span class="px-4 py-2 text-sm font-bold rounded-full
                                            @if($service->status == 'pending') bg-yellow-100 text-yellow-800
                                            @elseif($service->status == 'proses') bg-purple-100 text-purple-800
                                            @elseif($service->status == 'selesai') bg-green-100 text-green-800
                                            @elseif($service->status == 'diambil') bg-indigo-100 text-indigo-800
                                            @else bg-red-100 text-red-800
                                            @endif">
                                            {{ ucfirst($service->status) }}
                                        </span>
                                        @if($service->prioritas == 'urgent')
                                            <span class="px-3 py-2 text-xs font-bold rounded-full bg-red-100 text-red-800">
                                                🔥 Urgent
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <!-- Device Info -->
                                <div class="bg-gradient-to-r from-blue-50 to-cyan-50 rounded-lg p-4 mb-4">
                                    <div class="flex items-center">
                                        <div class="bg-blue-100 p-3 rounded-lg">
                                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <p class="text-xs text-gray-600 mb-1">Perangkat</p>
                                            <p class="font-bold text-gray-900">{{ $service->device->kategori }} - {{ $service->device->merk }} {{ $service->device->model }}</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Info Grid -->
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                                    <div>
                                        <p class="text-xs text-gray-500 mb-1">Keluhan</p>
                                        <p class="text-sm text-gray-700">{{ Str::limit($service->keluhan, 80) }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 mb-1">Teknisi</p>
                                        <p class="text-sm font-semibold text-gray-900">
                                            {{ $service->technician ? $service->technician->user->nama : 'Belum ditentukan' }}
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 mb-1">Total Biaya</p>
                                        <p class="text-xl font-bold text-blue-600">
                                            Rp {{ number_format($service->biaya_total, 0, ',', '.') }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Payment Status & Actions -->
                                <div class="flex flex-wrap justify-between items-center pt-4 border-t border-gray-200 gap-4">
                                    <div>
                                        @if($service->payment)
                                            @if($service->payment->status == 'verified')
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                    </svg>
                                                    Pembayaran Terverifikasi
                                                </span>
                                            @elseif($service->payment->status == 'pending')
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                    </svg>
                                                    Menunggu Verifikasi
                                                </span>
                                            @elseif($service->payment->status == 'rejected')
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                    </svg>
                                                    Pembayaran Ditolak
                                                </span>
                                            @endif
                                        @else
                                            @if($service->status == 'selesai')
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                    </svg>
                                                    Belum Dibayar
                                                </span>
                                            @endif
                                        @endif
                                    </div>

                                    <div class="flex gap-2">
                                        @if($service->status == 'selesai' && !$service->payment)
                                            <a href="{{ route('customer.payments.create', $service->id) }}" 
                                                class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg transition">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                                </svg>
                                                Bayar Sekarang
                                            </a>
                                        @endif
                                        
                                        <a href="{{ route('customer.services.show', $service->id) }}" 
                                            class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg transition">
                                            Lihat Detail
                                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $services->links() }}
                </div>
            @else
                <!-- Empty State -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                    <div class="p-12 text-center">
                        <div class="inline-block p-6 bg-gray-100 rounded-full mb-6">
                            <svg class="h-20 w-20 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Belum Ada Servis</h3>
                        <p class="text-gray-600 mb-6 max-w-md mx-auto">
                            Anda belum memiliki riwayat servis. Ajukan servis pertama Anda sekarang!
                        </p>
                        <a href="{{ route('customer.services.create') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold rounded-lg hover:from-indigo-700 hover:to-purple-700 transition shadow-lg">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Ajukan Servis Pertama
                        </a>
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>