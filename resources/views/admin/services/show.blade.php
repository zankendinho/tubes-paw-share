<x-app-layout>
  <x-slot name="header">
    <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Servis') }} - {{ $service->kode_servis }}
        </h2>
        <div class="flex space-x-2">
            <a href="{{ route('admin.service-details.index', $service->id) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                🔧 Kelola Spare Parts
            </a>
            <a href="{{ route('admin.services.edit', $service->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Edit Servis
            </a>
            <a href="{{ route('admin.services.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                ← Kembali
            </a>
        </div>
    </div>
</x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Foto Device (Jika ada) -->
            @if($service->device->foto)
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Foto Perangkat yang Diservis</h3>
                    <div class="flex items-start space-x-6">
                        <!-- Foto -->
                        <div class="relative inline-block group">
                            <img 
                                src="{{ asset('storage/' . $service->device->foto) }}" 
                                alt="Foto {{ $service->device->kategori }} - {{ $service->device->merk }}" 
                                class="w-48 h-48 object-cover rounded-lg border-2 border-gray-300 shadow-md cursor-pointer transition-all duration-300 group-hover:shadow-xl group-hover:scale-105"
                                onclick="openImageModal(this.src)"
                            >
                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 rounded-lg transition-all duration-300 flex items-center justify-center">
                                <svg class="w-10 h-10 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/>
                                </svg>
                            </div>
                        </div>
                        
                        <!-- Info Device -->
                        <div class="flex-1">
                            <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded">
                                <div class="flex items-start">
                                    <svg class="w-5 h-5 text-blue-600 mt-0.5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <div>
                                        <p class="text-sm text-blue-800 font-semibold">{{ $service->device->kategori }} - {{ $service->device->merk }} {{ $service->device->model }}</p>
                                        <p class="text-xs text-blue-600 mt-1">Klik foto untuk memperbesar dan melihat detail kondisi perangkat</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Info Servis & Status -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <!-- Kode & Status -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">Status Servis</h3>
                        <div class="space-y-3">
                            <div>
                                <p class="text-sm text-gray-500">Kode Servis</p>
                                <p class="font-bold text-xl">{{ $service->kode_servis }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Status</p>
                                @if($service->status == 'pending')
                                    <span class="px-3 py-1 inline-flex text-sm font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                                @elseif($service->status == 'proses')
                                    <span class="px-3 py-1 inline-flex text-sm font-semibold rounded-full bg-blue-100 text-blue-800">Proses</span>
                                @elseif($service->status == 'selesai')
                                    <span class="px-3 py-1 inline-flex text-sm font-semibold rounded-full bg-green-100 text-green-800">Selesai</span>
                                @elseif($service->status == 'diambil')
                                    <span class="px-3 py-1 inline-flex text-sm font-semibold rounded-full bg-gray-100 text-gray-800">Diambil</span>
                                @else
                                    <span class="px-3 py-1 inline-flex text-sm font-semibold rounded-full bg-red-100 text-red-800">Batal</span>
                                @endif
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Prioritas</p>
                                @if($service->prioritas == 'urgent')
                                    <span class="px-3 py-1 inline-flex text-sm font-semibold rounded-full bg-red-100 text-red-800">Urgent</span>
                                @else
                                    <span class="px-3 py-1 inline-flex text-sm font-semibold rounded-full bg-gray-100 text-gray-800">Normal</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Info Customer -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">Customer</h3>
                        <div class="space-y-2">
                            <div>
                                <p class="text-sm text-gray-500">Nama</p>
                                <p class="font-semibold">{{ $service->customer->nama }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Telepon</p>
                                <p class="font-semibold">{{ $service->customer->telp }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Email</p>
                                <p class="font-semibold">{{ $service->customer->email }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Info Perangkat -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">Perangkat</h3>
                        <div class="space-y-2">
                            <div>
                                <p class="text-sm text-gray-500">Kategori</p>
                                <p class="font-semibold">{{ $service->device->kategori }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Merk & Model</p>
                                <p class="font-semibold">{{ $service->device->merk }} {{ $service->device->model }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Serial Number</p>
                                <p class="font-semibold">{{ $service->device->serial_number ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Detail Masalah & Tindakan -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Detail Masalah & Tindakan</h3>
                    
                    <div class="space-y-4">
                        <div>
                            <p class="text-sm font-medium text-gray-700">Keluhan</p>
                            <p class="mt-1 text-gray-900">{{ $service->keluhan }}</p>
                        </div>
                        
                        @if($service->diagnosa)
                        <div>
                            <p class="text-sm font-medium text-gray-700">Diagnosa</p>
                            <p class="mt-1 text-gray-900">{{ $service->diagnosa }}</p>
                        </div>
                        @endif
                        
                        @if($service->tindakan)
                        <div>
                            <p class="text-sm font-medium text-gray-700">Tindakan</p>
                            <p class="mt-1 text-gray-900">{{ $service->tindakan }}</p>
                        </div>
                        @endif
                        
                        @if($service->catatan)
                        <div>
                            <p class="text-sm font-medium text-gray-700">Catatan</p>
                            <p class="mt-1 text-gray-900">{{ $service->catatan }}</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Timeline & Biaya -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <!-- Timeline -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">Timeline</h3>
                        <div class="space-y-3">
                            <div>
                                <p class="text-sm text-gray-500">Tanggal Masuk</p>
                                <p class="font-semibold">{{ $service->tanggal_masuk->format('d M Y') }}</p>
                            </div>
                            @if($service->tanggal_mulai)
                            <div>
                                <p class="text-sm text-gray-500">Tanggal Mulai</p>
                                <p class="font-semibold">{{ $service->tanggal_mulai->format('d M Y') }}</p>
                            </div>
                            @endif
                            @if($service->tanggal_estimasi_selesai)
                            <div>
                                <p class="text-sm text-gray-500">Estimasi Selesai</p>
                                <p class="font-semibold">{{ $service->tanggal_estimasi_selesai->format('d M Y') }}</p>
                            </div>
                            @endif
                            @if($service->tanggal_selesai)
                            <div>
                                <p class="text-sm text-gray-500">Tanggal Selesai</p>
                                <p class="font-semibold">{{ $service->tanggal_selesai->format('d M Y') }}</p>
                            </div>
                            @endif
                            <div>
                                <p class="text-sm text-gray-500">Teknisi</p>
                                <p class="font-semibold">{{ $service->technician ? $service->technician->user->nama : 'Belum ditentukan' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Biaya -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">Rincian Biaya</h3>
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <p class="text-sm text-gray-500">Biaya Jasa</p>
                                <p class="font-semibold">Rp {{ number_format($service->biaya_jasa, 0, ',', '.') }}</p>
                            </div>
                            <div class="flex justify-between">
                                <p class="text-sm text-gray-500">Biaya Spare Part</p>
                                <p class="font-semibold">Rp {{ number_format($service->biaya_sparepart, 0, ',', '.') }}</p>
                            </div>
                            <hr>
                            <div class="flex justify-between">
                                <p class="text-base font-bold">Total Biaya</p>
                                <p class="text-xl font-bold text-blue-600">Rp {{ number_format($service->biaya_total, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Spare Parts yang Digunakan -->
            @if($service->serviceDetails->count() > 0)
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Spare Part yang Digunakan</h3>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Part</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kode</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Qty</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Harga Satuan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($service->serviceDetails as $detail)
                                <tr>
                                    <td class="px-6 py-4 text-sm">{{ $detail->sparePart->nama_part }}</td>
                                    <td class="px-6 py-4 text-sm">{{ $detail->sparePart->kode_part }}</td>
                                    <td class="px-6 py-4 text-sm">{{ $detail->qty }}</td>
                                    <td class="px-6 py-4 text-sm">Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 text-sm font-semibold">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                                </tr>
                                 @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif

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
        document.body.style.overflow = 'hidden';
    }

    function closeImageModal() {
        document.getElementById('imageModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // Close modal with ESC key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeImageModal();
        }
    });
    </script>
</x-app-layout>