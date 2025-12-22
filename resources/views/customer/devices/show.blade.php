<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Perangkat') }}
            </h2>
            <a href="{{ route('customer.devices.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-semibold rounded-lg transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Info Perangkat Card -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <!-- Header with Gradient -->
                <div class="bg-gradient-to-r from-blue-500 via-cyan-500 to-teal-500 px-8 py-6">
                    <div class="flex items-center">
                        <div class="bg-white/20 backdrop-blur-sm rounded-xl p-4">
                            <svg class="h-12 w-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                        <div class="ml-6">
                            <h3 class="text-3xl font-bold text-white">{{ $device->kategori }}</h3>
                            <p class="text-blue-100 text-lg mt-1">{{ $device->merk }} {{ $device->model }}</p>
                        </div>
                    </div>
                </div>

                <!-- Body -->
                <div class="p-8">
                    <!-- Foto Device Section -->
                    @if($device->foto)
                        <div class="mb-8 pb-8 border-b border-gray-200">
                            <h4 class="text-lg font-semibold text-gray-900 mb-4">Foto Perangkat</h4>
                            <div class="relative inline-block group">
                                <img 
                                    src="{{ asset('storage/' . $device->foto) }}" 
                                    alt="Foto {{ $device->kategori }} - {{ $device->merk }}" 
                                    class="w-80 h-80 object-cover rounded-xl border-2 border-gray-300 shadow-lg cursor-pointer transition-all duration-300 group-hover:shadow-2xl group-hover:scale-105"
                                    onclick="openImageModal(this.src)"
                                >
                                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 rounded-xl transition-all duration-300 flex items-center justify-center">
                                    <svg class="w-12 h-12 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/>
                                    </svg>
                                </div>
                            </div>
                            <p class="text-xs text-gray-500 mt-2">Klik foto untuk memperbesar</p>
                        </div>
                    @endif

                    <h4 class="text-lg font-semibold text-gray-900 mb-6">Informasi Perangkat</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div class="bg-gray-50 rounded-lg p-4">
                            <p class="text-xs text-gray-500 font-medium mb-2">Kategori</p>
                            <p class="text-xl font-bold text-blue-600">{{ $device->kategori }}</p>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <p class="text-xs text-gray-500 font-medium mb-2">Merk</p>
                            <p class="text-lg font-semibold text-gray-900">{{ $device->merk }}</p>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <p class="text-xs text-gray-500 font-medium mb-2">Model</p>
                            <p class="text-lg font-semibold text-gray-900">{{ $device->model ?? '-' }}</p>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <p class="text-xs text-gray-500 font-medium mb-2">Serial Number</p>
                            <p class="text-lg font-mono font-semibold text-gray-900">{{ $device->serial_number ?? '-' }}</p>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <p class="text-xs text-gray-500 font-medium mb-2">Tahun Pembelian</p>
                            <p class="text-lg font-semibold text-gray-900">{{ $device->tahun_beli ?? '-' }}</p>
                        </div>
                        <div class="bg-gradient-to-br from-blue-500 to-cyan-500 rounded-lg p-4">
                            <p class="text-xs text-blue-100 font-medium mb-2">Total Servis</p>
                            <p class="text-3xl font-bold text-white">{{ $device->services->count() }} <span class="text-lg font-normal">kali</span></p>
                        </div>
                        @if($device->kondisi)
                            <div class="bg-gray-50 rounded-lg p-4 md:col-span-2 lg:col-span-3">
                                <p class="text-xs text-gray-500 font-medium mb-2">Kondisi Perangkat</p>
                                <p class="text-sm text-gray-700">{{ $device->kondisi }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Riwayat Servis -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <div class="bg-gradient-to-r from-purple-500 to-pink-500 px-8 py-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-2xl font-bold text-white">Riwayat Servis</h3>
                            <p class="text-purple-100 mt-1">{{ $device->services->count() }} servis tercatat</p>
                        </div>
                        <div class="bg-white/20 backdrop-blur-sm rounded-lg px-4 py-2">
                            <p class="text-white text-2xl font-bold">{{ $device->services->count() }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="p-8">
                    @if($device->services->count() > 0)
                        <div class="space-y-4">
                            @foreach($device->services->sortByDesc('created_at') as $service)
                                <div class="border-l-4 
                                    @if($service->status == 'pending') border-yellow-500 
                                    @elseif($service->status == 'proses') border-purple-500 
                                    @elseif($service->status == 'selesai') border-green-500 
                                    @elseif($service->status == 'diambil') border-indigo-500
                                    @else border-red-500 
                                    @endif 
                                    bg-gray-50 rounded-r-xl p-6 hover:shadow-md transition">
                                    
                                    <div class="flex justify-between items-start mb-4">
                                        <div>
                                            <h4 class="text-lg font-bold text-gray-900">{{ $service->kode_servis }}</h4>
                                            <p class="text-sm text-gray-600 mt-1">
                                                <svg class="inline w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                                {{ $service->tanggal_masuk->format('d M Y') }}
                                            </p>
                                        </div>
                                        <span class="px-4 py-2 text-sm font-bold rounded-full
                                            @if($service->status == 'pending') bg-yellow-100 text-yellow-800
                                            @elseif($service->status == 'proses') bg-purple-100 text-purple-800
                                            @elseif($service->status == 'selesai') bg-green-100 text-green-800
                                            @elseif($service->status == 'diambil') bg-indigo-100 text-indigo-800
                                            @else bg-red-100 text-red-800
                                            @endif">
                                            {{ ucfirst($service->status) }}
                                        </span>
                                    </div>
                                    
                                    <div class="space-y-3 mb-4">
                                        <div>
                                            <p class="text-xs text-gray-500 font-medium mb-1">Keluhan</p>
                                            <p class="text-sm text-gray-700">{{ $service->keluhan }}</p>
                                        </div>

                                        @if($service->diagnosa)
                                            <div>
                                                <p class="text-xs text-gray-500 font-medium mb-1">Diagnosa</p>
                                                <p class="text-sm text-gray-700">{{ $service->diagnosa }}</p>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="flex flex-wrap gap-4 pt-4 border-t border-gray-200">
                                        <div class="flex-1 min-w-[200px]">
                                            <p class="text-xs text-gray-500 mb-1">Teknisi</p>
                                            <p class="font-semibold text-gray-900">{{ $service->technician ? $service->technician->user->nama : 'Belum ditentukan' }}</p>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-xs text-gray-500 mb-1">Total Biaya</p>
                                            <p class="text-xl font-bold text-blue-600">Rp {{ number_format($service->biaya_total, 0, ',', '.') }}</p>
                                        </div>
                                    </div>

                                    <div class="mt-4">
                                        <a href="{{ route('customer.services.show', $service->id) }}" 
                                            class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold text-sm transition">
                                            Lihat Detail Servis
                                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="inline-block p-4 bg-gray-100 rounded-full mb-4">
                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                            </div>
                            <p class="text-gray-600 font-medium">Perangkat ini belum pernah diservis</p>
                            <p class="text-gray-500 text-sm mt-2">Riwayat servis akan muncul di sini</p>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>

    <!-- Modal untuk Zoom Foto -->
    <div id="imageModal" class="hidden fixed inset-0 bg-black bg-opacity-90 z-50 flex items-center justify-center p-4" onclick="closeImageModal()">
        <div class="relative max-w-6xl max-h-screen">
            <button onclick="closeImageModal()" class="absolute -top-12 right-0 text-white text-4xl font-bold hover:text-gray-300 transition">
                &times;
            </button>
            <img id="modalImage" class="max-w-full max-h-screen object-contain rounded-lg shadow-2xl">
        </div>
    </div>

    <!-- JavaScript untuk Modal -->
    <script>
    function openImageModal(src) {
        document.getElementById('modalImage').src = src;
        document.getElementById('imageModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden'; // Prevent scrolling
    }

    function closeImageModal() {
        document.getElementById('imageModal').classList.add('hidden');
        document.body.style.overflow = 'auto'; // Re-enable scrolling
    }

    // Close modal with ESC key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeImageModal();
        }
    });
    </script>
</x-app-layout>