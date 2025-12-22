<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Welcome Banner with Gradient -->
            <div class="bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 rounded-2xl shadow-xl mb-8 overflow-hidden">
                <div class="px-8 py-10">
                    <h3 class="text-3xl font-bold text-white mb-2">
                        Halo, {{ $customer->nama }}! 👋
                    </h3>
                    <p class="text-indigo-100 text-lg">Selamat datang kembali di dashboard Anda</p>
                </div>
                
                <!-- Decorative wave -->
                <svg class="w-full" viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-bottom: -1px;">
                    <path d="M0 120L60 105C120 90 240 60 360 45C480 30 600 30 720 37.5C840 45 960 60 1080 67.5C1200 75 1320 75 1380 75L1440 75V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0Z" fill="white"/>
                </svg>
            </div>

            <!-- Quick Actions -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <a href="{{ route('customer.services.create') }}" class="group">
                    <div class="bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl p-6 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                        <div class="flex items-center justify-between">
                            <div>
                                <h4 class="text-white text-lg font-semibold mb-1">Ajukan Servis</h4>
                                <p class="text-indigo-100 text-sm">Servis perangkat elektronik Anda</p>
                            </div>
                            <div class="bg-white/20 p-3 rounded-lg group-hover:bg-white/30 transition">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </a>

                <a href="{{ route('customer.devices.create') }}" class="group">
                    <div class="bg-gradient-to-br from-blue-500 to-cyan-600 rounded-xl p-6 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                        <div class="flex items-center justify-between">
                            <div>
                                <h4 class="text-white text-lg font-semibold mb-1">Tambah Perangkat</h4>
                                <p class="text-blue-100 text-sm">Daftarkan perangkat baru</p>
                            </div>
                            <div class="bg-white/20 p-3 rounded-lg group-hover:bg-white/30 transition">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Statistics Cards - Compact Grid -->
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-7 gap-4 mb-8">
                
                <!-- Card Perangkat -->
                <div class="bg-white rounded-xl p-4 shadow-md hover:shadow-lg transition border-l-4 border-blue-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs text-gray-500 mb-1">Perangkat</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $totalDevices }}</p>
                        </div>
                        <div class="bg-blue-100 p-2 rounded-lg">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Card Total -->
                <div class="bg-white rounded-xl p-4 shadow-md hover:shadow-lg transition border-l-4 border-green-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs text-gray-500 mb-1">Total</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $totalServices }}</p>
                        </div>
                        <div class="bg-green-100 p-2 rounded-lg">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Card Pending -->
                <div class="bg-white rounded-xl p-4 shadow-md hover:shadow-lg transition border-l-4 border-yellow-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs text-gray-500 mb-1">Pending</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $servicePending }}</p>
                        </div>
                        <div class="bg-yellow-100 p-2 rounded-lg">
                            <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Card Proses -->
                <div class="bg-white rounded-xl p-4 shadow-md hover:shadow-lg transition border-l-4 border-purple-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs text-gray-500 mb-1">Proses</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $serviceProses }}</p>
                        </div>
                        <div class="bg-purple-100 p-2 rounded-lg">
                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Card Selesai -->
                <div class="bg-white rounded-xl p-4 shadow-md hover:shadow-lg transition border-l-4 border-emerald-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs text-gray-500 mb-1">Selesai</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $serviceSelesai }}</p>
                        </div>
                        <div class="bg-emerald-100 p-2 rounded-lg">
                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Card Diambil -->
                <div class="bg-white rounded-xl p-4 shadow-md hover:shadow-lg transition border-l-4 border-indigo-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs text-gray-500 mb-1">Diambil</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $serviceDiambil }}</p>
                        </div>
                        <div class="bg-indigo-100 p-2 rounded-lg">
                            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Card Batal -->
                <div class="bg-white rounded-xl p-4 shadow-md hover:shadow-lg transition border-l-4 border-red-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs text-gray-500 mb-1">Batal</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $serviceBatal }}</p>
                        </div>
                        <div class="bg-red-100 p-2 rounded-lg">
                            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- Left Column - Perangkat Saya -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                        <div class="bg-gradient-to-r from-blue-500 to-cyan-500 px-6 py-4">
                            <div class="flex justify-between items-center">
                                <h3 class="text-lg font-semibold text-white">Perangkat Saya</h3>
                                <a href="{{ route('customer.devices.index') }}" class="text-white hover:text-blue-100 text-sm font-medium">
                                    Lihat Semua →
                                </a>
                            </div>
                        </div>
                        
                        <div class="p-6">
                            @if($devices->isEmpty())
                                <div class="text-center py-12">
                                    <div class="inline-block p-4 bg-gray-100 rounded-full mb-4">
                                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <p class="text-gray-500 mb-4">Belum ada perangkat terdaftar</p>
                                    <a href="{{ route('customer.devices.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                        </svg>
                                        Tambah Perangkat Pertama
                                    </a>
                                </div>
                            @else
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    @foreach($devices->take(4) as $device)
                                        <a href="{{ route('customer.devices.show', $device->id) }}" class="group">
                                            <div class="border border-gray-200 rounded-lg p-4 hover:border-blue-500 hover:shadow-md transition">
                                                <div class="flex items-start">
                                                    <div class="bg-gradient-to-br from-blue-100 to-cyan-100 rounded-lg p-3 group-hover:from-blue-200 group-hover:to-cyan-200 transition">
                                                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                                        </svg>
                                                    </div>
                                                    <div class="ml-3 flex-1">
                                                        <p class="font-semibold text-gray-900 group-hover:text-blue-600">{{ $device->kategori }}</p>
                                                        <p class="text-sm text-gray-600">{{ $device->merk }} {{ $device->model }}</p>
                                                        <div class="mt-2 flex items-center text-xs text-gray-500">
                                                            <span class="bg-gray-100 px-2 py-1 rounded">
                                                                {{ $device->services->count() }} servis
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Right Column - Riwayat Servis Terbaru -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                        <div class="bg-gradient-to-r from-purple-500 to-pink-500 px-6 py-4">
                            <div class="flex justify-between items-center">
                                <h3 class="text-lg font-semibold text-white">Servis Terbaru</h3>
                                <a href="{{ route('customer.services.index') }}" class="text-white hover:text-purple-100 text-sm font-medium">
                                    Semua →
                                </a>
                            </div>
                        </div>
                        
                        <div class="p-6">
                            @if($recentServices->isEmpty())
                                <div class="text-center py-8">
                                    <div class="inline-block p-3 bg-gray-100 rounded-full mb-3">
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                        </svg>
                                    </div>
                                    <p class="text-gray-500 text-sm">Belum ada riwayat servis</p>
                                </div>
                            @else
                                <div class="space-y-4">
                                    @foreach($recentServices as $service)
                                        <a href="{{ route('customer.services.show', $service->id) }}" class="block group">
                                            <div class="border-l-4 
                                                @if($service->status == 'pending') border-yellow-500 
                                                @elseif($service->status == 'proses') border-purple-500 
                                                @elseif($service->status == 'selesai') border-green-500 
                                                @elseif($service->status == 'diambil') border-indigo-500
                                                @else border-red-500 
                                                @endif 
                                                bg-gray-50 p-4 rounded-r-lg hover:bg-gray-100 transition">
                                                <div class="flex justify-between items-start mb-2">
                                                    <span class="text-xs font-mono text-gray-600">{{ $service->kode_servis }}</span>
                                                    <span class="px-2 py-1 text-xs font-semibold rounded-full
                                                        @if($service->status == 'pending') bg-yellow-100 text-yellow-800
                                                        @elseif($service->status == 'proses') bg-purple-100 text-purple-800
                                                        @elseif($service->status == 'selesai') bg-green-100 text-green-800
                                                        @elseif($service->status == 'diambil') bg-indigo-100 text-indigo-800
                                                        @else bg-red-100 text-red-800
                                                        @endif">
                                                        {{ ucfirst($service->status) }}
                                                    </span>
                                                </div>
                                                <p class="text-sm font-medium text-gray-900 mb-1">{{ $service->device->kategori }} - {{ $service->device->merk }}</p>
                                                <p class="text-xs text-gray-600">{{ Str::limit($service->keluhan, 50) }}</p>
                                                <p class="text-xs text-gray-500 mt-2">{{ $service->tanggal_masuk->format('d M Y') }}</p>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>