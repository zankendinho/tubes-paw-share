<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Perangkat') }}
            </h2>
            <a href="{{ route('admin.devices.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                ← Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Foto Perangkat (Jika ada) -->
            @if($device->foto)
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Foto Perangkat</h3>
                    <div class="flex items-start space-x-4">
                        <div class="relative inline-block group">
                            <img 
                                src="{{ asset('storage/' . $device->foto) }}" 
                                alt="Foto {{ $device->kategori }} - {{ $device->merk }}" 
                                class="w-64 h-64 object-cover rounded-lg border-2 border-gray-300 shadow-md cursor-pointer transition-all duration-300 group-hover:shadow-xl group-hover:scale-105"
                                onclick="openImageModal(this.src)"
                            >
                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 rounded-lg transition-all duration-300 flex items-center justify-center">
                                <svg class="w-10 h-10 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/>
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1">
                            <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded">
                                <p class="text-sm text-blue-800">
                                    <svg class="inline w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <strong>Klik foto untuk memperbesar</strong>
                                </p>
                                <p class="text-xs text-blue-600 mt-2">Foto ini diupload oleh customer saat mendaftarkan perangkat</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Informasi Perangkat -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Informasi Perangkat</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <p class="text-sm text-gray-500">Pemilik</p>
                            <p class="font-semibold">{{ $device->customer->nama }}</p>
                            <p class="text-sm text-gray-500">{{ $device->customer->telp }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Kategori</p>
                            <span class="px-3 py-1 inline-flex text-sm font-semibold rounded-full bg-blue-100 text-blue-800">
                                {{ $device->kategori }}
                            </span>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Merk</p>
                            <p class="font-semibold">{{ $device->merk }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Model</p>
                            <p class="font-semibold">{{ $device->model ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Serial Number</p>
                            <p class="font-semibold">{{ $device->serial_number ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Tahun Pembelian</p>
                            <p class="font-semibold">{{ $device->tahun_beli ?? '-' }}</p>
                        </div>
                        <div class="md:col-span-2">
                            <p class="text-sm text-gray-500">Kondisi</p>
                            <p class="font-semibold">{{ $device->kondisi ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Riwayat Servis -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Riwayat Servis ({{ $device->services->count() }})</h3>
                    
                    @if($device->services->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kode Servis</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Keluhan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Teknisi</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($device->services as $service)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $service->kode_servis }}</td>
                                    <td class="px-6 py-4 text-sm">{{ Str::limit($service->keluhan, 50) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        {{ $service->technician ? $service->technician->user->nama : 'Belum ditentukan' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($service->status == 'pending')
                                            <span class="px-2 text-xs rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                                        @elseif($service->status == 'proses')
                                            <span class="px-2 text-xs rounded-full bg-blue-100 text-blue-800">Proses</span>
                                        @elseif($service->status == 'selesai')
                                            <span class="px-2 text-xs rounded-full bg-green-100 text-green-800">Selesai</span>
                                        @elseif($service->status == 'diambil')
                                            <span class="px-2 text-xs rounded-full bg-indigo-100 text-indigo-800">Diambil</span>
                                        @elseif($service->status == 'batal')
                                            <span class="px-2 text-xs rounded-full bg-red-100 text-red-800">Batal</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $service->tanggal_masuk->format('d M Y') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <p class="text-gray-500">Belum ada riwayat servis</p>
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