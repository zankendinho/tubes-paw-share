<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Spare Part') }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('admin.spare-parts.edit', $sparePart->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Edit Spare Part
                </a>
                <a href="{{ route('admin.spare-parts.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    ← Kembali
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Info Spare Part -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <!-- Info Dasar -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">Informasi Dasar</h3>
                        <div class="space-y-3">
                            <div>
                                <p class="text-sm text-gray-500">Kode Part</p>
                                <p class="font-bold text-xl">{{ $sparePart->kode_part }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Nama Part</p>
                                <p class="font-semibold">{{ $sparePart->nama_part }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Kategori</p>
                                <p class="font-semibold">{{ $sparePart->kategori ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Supplier</p>
                                <p class="font-semibold">{{ $sparePart->supplier ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Stok -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">Stok</h3>
                        <div class="space-y-3">
                            <div>
                                <p class="text-sm text-gray-500">Stok Tersedia</p>
                                <p class="text-3xl font-bold {{ $sparePart->stok == 0 ? 'text-red-600' : ($sparePart->stok <= $sparePart->stok_minimum ? 'text-yellow-600' : 'text-green-600') }}">
                                    {{ $sparePart->stok }}
                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Stok Minimum</p>
                                <p class="font-semibold">{{ $sparePart->stok_minimum }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Status Stok</p>
                                @if($sparePart->stok == 0)
                                    <span class="px-3 py-1 inline-flex text-sm font-semibold rounded-full bg-red-100 text-red-800">Habis</span>
                                @elseif($sparePart->stok <= $sparePart->stok_minimum)
                                    <span class="px-3 py-1 inline-flex text-sm font-semibold rounded-full bg-yellow-100 text-yellow-800">Menipis</span>
                                @else
                                    <span class="px-3 py-1 inline-flex text-sm font-semibold rounded-full bg-green-100 text-green-800">Aman</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Harga -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">Harga</h3>
                        <div class="space-y-3">
                            <div>
                                <p class="text-sm text-gray-500">Harga Beli</p>
                                <p class="font-semibold">Rp {{ number_format($sparePart->harga_beli, 0, ',', '.') }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Harga Jual</p>
                                <p class="text-xl font-bold text-blue-600">Rp {{ number_format($sparePart->harga_jual, 0, ',', '.') }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Margin</p>
                                <p class="font-semibold text-green-600">
                                    Rp {{ number_format($sparePart->harga_jual - $sparePart->harga_beli, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Keterangan -->
            @if($sparePart->keterangan)
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Keterangan</h3>
                    <p class="text-gray-700">{{ $sparePart->keterangan }}</p>
                </div>
            </div>
            @endif

            <!-- Riwayat Penggunaan -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Riwayat Penggunaan ({{ $sparePart->serviceDetails->count() }} kali)</h3>
                    
                    @if($sparePart->serviceDetails->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kode Servis</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Customer</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Qty</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Harga</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($sparePart->serviceDetails->sortByDesc('created_at')->take(10) as $detail)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $detail->created_at->format('d M Y') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('admin.services.show', $detail->service->id) }}" class="text-blue-600 hover:text-blue-900">
                                            {{ $detail->service->kode_servis }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $detail->service->customer->nama }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $detail->qty }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <p class="text-gray-500 text-center py-8">Belum pernah digunakan</p>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>