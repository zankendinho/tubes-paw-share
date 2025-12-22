<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Teknisi') }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('admin.technicians.edit', $technician->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Edit Teknisi
                </a>
                <a href="{{ route('admin.technicians.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    ← Kembali
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Info Teknisi & Statistik -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <!-- Info Teknisi -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">Informasi Teknisi</h3>
                        <div class="space-y-3">
                            <div>
                                <p class="text-sm text-gray-500">Nama</p>
                                <p class="font-semibold">{{ $technician->user->nama }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Username</p>
                                <p class="font-semibold">{{ $technician->user->username }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Email</p>
                                <p class="font-semibold">{{ $technician->user->email }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Telepon</p>
                                <p class="font-semibold">{{ $technician->user->telp }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Status Akun</p>
                                @if($technician->user->status == 'aktif')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Nonaktif</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Spesialisasi & Pengalaman -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">Keahlian</h3>
                        <div class="space-y-3">
                            <div>
                                <p class="text-sm text-gray-500">Spesialisasi</p>
                                <p class="font-semibold">{{ $technician->spesialisasi }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Pengalaman</p>
                                <p class="font-semibold">{{ $technician->pengalaman }} tahun</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Status</p>
                                @if($technician->status == 'tersedia')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Tersedia</span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Sibuk</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Statistik -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">Statistik</h3>
                        <div class="space-y-3">
                            <div>
                                <p class="text-sm text-gray-500">Rating</p>
                                <div class="flex items-center">
                                    <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    <span class="ml-1 text-xl font-bold">{{ number_format($technician->rating, 1) }}</span>
                                </div>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Total Servis</p>
                                <p class="text-xl font-bold text-blue-600">{{ $technician->total_servis }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Servis Aktif</p>
                                <p class="text-xl font-bold text-yellow-600">{{ $technician->services()->whereIn('status', ['pending', 'proses'])->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Riwayat Servis -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Riwayat Servis ({{ $technician->services->count() }})</h3>
                    
                    @if($technician->services->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kode Servis</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Customer</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Perangkat</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Keluhan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($technician->services->sortByDesc('created_at')->take(10) as $service)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('admin.services.show', $service->id) }}" class="text-blue-600 hover:text-blue-900">
                                            {{ $service->kode_servis }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $service->customer->nama }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $service->device->kategori }} - {{ $service->device->merk }}</td>
                                    <td class="px-6 py-4 text-sm">{{ Str::limit($service->keluhan, 40) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($service->status == 'pending')
                                            <span class="px-2 text-xs rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                                        @elseif($service->status == 'proses')
                                            <span class="px-2 text-xs rounded-full bg-blue-100 text-blue-800">Proses</span>
                                        @elseif($service->status == 'selesai')
                                            <span class="px-2 text-xs rounded-full bg-green-100 text-green-800">Selesai</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $service->tanggal_masuk->format('d M Y') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <p class="text-gray-500 text-center py-4
                    ">Tidak ada riwayat servis</p>
                    @endif

                </div>
            </div>

        </div>
    </div>
</x-app-layout>


