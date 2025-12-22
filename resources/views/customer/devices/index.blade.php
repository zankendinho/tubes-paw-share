<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Perangkat Saya') }}
            </h2>
            <a href="{{ route('customer.devices.create') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-cyan-600 text-white font-semibold rounded-lg hover:from-blue-700 hover:to-cyan-700 transition shadow-lg">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Perangkat
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Stats Banner -->
            <div class="bg-gradient-to-r from-blue-500 via-cyan-500 to-teal-500 rounded-2xl shadow-xl mb-8 overflow-hidden">
                <div class="px-8 py-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-blue-100 text-sm font-medium">Total Perangkat Terdaftar</p>
                            <p class="text-4xl font-bold text-white mt-1">{{ $devices->count() }}</p>
                        </div>
                        <div class="bg-white/20 p-4 rounded-xl">
                            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Grid Perangkat -->
            @if($devices->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($devices as $device)
                        <div class="bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 overflow-hidden border border-gray-100">
                            <!-- Header Card with Icon -->
                            <div class="bg-gradient-to-br from-blue-500 to-cyan-500 px-6 py-4">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="bg-white/20 backdrop-blur-sm rounded-lg p-3">
                                            <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                @if($device->kategori == 'Laptop' || $device->kategori == 'PC')
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                                @elseif($device->kategori == 'TV')
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                                @elseif($device->kategori == 'AC')
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707"/>
                                                @elseif($device->kategori == 'Kulkas')
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                                @else
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                                @endif
                                            </svg>
                                        </div>
                                        <div class="ml-3">
                                            <h3 class="text-lg font-bold text-white">{{ $device->kategori }}</h3>
                                            <p class="text-sm text-blue-100">{{ $device->merk }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Body Card -->
                            <div class="p-6">
                                <!-- Info Detail -->
                                <div class="space-y-3 mb-4">
                                    <div class="flex justify-between items-center">
                                        <span class="text-xs text-gray-500 font-medium">Model</span>
                                        <span class="text-sm font-semibold text-gray-900">{{ $device->model ?? '-' }}</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-xs text-gray-500 font-medium">Serial Number</span>
                                        <span class="text-sm font-mono font-semibold text-gray-900">{{ $device->serial_number ?? '-' }}</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-xs text-gray-500 font-medium">Tahun Beli</span>
                                        <span class="text-sm font-semibold text-gray-900">{{ $device->tahun_beli ?? '-' }}</span>
                                    </div>
                                </div>

                                <!-- Riwayat Servis Badge -->
                                <div class="bg-gradient-to-r from-blue-50 to-cyan-50 rounded-lg p-4 mb-4">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-xs text-blue-600 font-medium mb-1">Riwayat Servis</p>
                                            <p class="text-2xl font-bold text-blue-700">{{ $device->services->count() }} <span class="text-sm font-normal">kali</span></p>
                                        </div>
                                        <div class="bg-blue-100 p-2 rounded-lg">
                                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                <!-- Action Button -->
                                <a href="{{ route('customer.devices.show', $device->id) }}" 
                                    class="w-full inline-flex items-center justify-center px-4 py-3 bg-gradient-to-r from-blue-600 to-cyan-600 text-white font-semibold rounded-lg hover:from-blue-700 hover:to-cyan-700 transition shadow-md hover:shadow-lg">
                                    Lihat Detail
                                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                    <div class="p-12 text-center">
                        <div class="inline-block p-6 bg-gray-100 rounded-full mb-6">
                            <svg class="h-20 w-20 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Belum Ada Perangkat</h3>
                        <p class="text-gray-600 mb-6 max-w-md mx-auto">
                            Anda belum memiliki perangkat yang terdaftar. Tambahkan perangkat pertama Anda untuk memulai!
                        </p>
                        <a href="{{ route('customer.devices.create') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-cyan-600 text-white font-semibold rounded-lg hover:from-blue-700 hover:to-cyan-700 transition shadow-lg">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Tambah Perangkat Pertama
                        </a>
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>