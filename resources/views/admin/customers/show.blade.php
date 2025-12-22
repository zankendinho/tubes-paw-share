<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Customer') }}
            </h2>
            <a href="{{ route('admin.customers.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                ← Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Informasi Customer -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Informasi Customer</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <p class="text-sm text-gray-500">Nama Lengkap</p>
                            <p class="font-semibold">{{ $customer->nama }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Username</p>
                            <p class="font-semibold">{{ $customer->user->username }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Email</p>
                            <p class="font-semibold">{{ $customer->email }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Nomor Telepon</p>
                            <p class="font-semibold">{{ $customer->telp }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Tanggal Daftar</p>
                            <p class="font-semibold">{{ $customer->tanggal_daftar->format('d M Y') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Status</p>
                            @if($customer->user->status == 'aktif')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Aktif
                                </span>
                            @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                    Nonaktif
                                </span>
                            @endif
                        </div>
                        <div class="md:col-span-2">
                            <p class="text-sm text-gray-500">Alamat</p>
                            <p class="font-semibold">{{ $customer->alamat ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Perangkat Customer -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Perangkat Terdaftar ({{ $customer->devices->count() }})</h3>
                    
                    @if($customer->devices->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        @foreach($customer->devices as $device)
                        <div class="border rounded-lg p-4">
                            <p class="font-semibold">{{ $device->kategori }}</p>
                            <p class="text-sm text-gray-600">{{ $device->merk }} {{ $device->model }}</p>
                            <p class="text-xs text-gray-500 mt-2">S/N: {{ $device->serial_number ?? '-' }}</p>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <p class="text-gray-500">Belum ada perangkat terdaftar</p>
                    @endif
                </div>
            </div>

            <!-- Riwayat Servis -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Riwayat Servis ({{ $customer->services->count() }})</h3>
                    
                    @if($customer->services->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kode Servis</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Perangkat</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total Biaya</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($customer->services as $service)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $service->kode_servis }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $service->device->kategori }} - {{ $service->device->merk }}</td>
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
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">Rp {{ number_format($service->biaya_total, 0, ',', '.') }}</td>
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
</x-app-layout>