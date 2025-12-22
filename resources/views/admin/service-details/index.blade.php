<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Kelola Spare Parts - Servis') }} {{ $service->kode_servis }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('admin.services.show', $service->id) }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    ← Kembali ke Servis
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                {{ session('error') }}
            </div>
            @endif

            <!-- Info Servis -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Informasi Servis</h3>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <p class="text-sm text-gray-500">Customer</p>
                            <p class="font-semibold">{{ $service->customer->nama }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Perangkat</p>
                            <p class="font-semibold">{{ $service->device->kategori }} - {{ $service->device->merk }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Status</p>
                            @if($service->status == 'pending')
                                <span class="px-2 text-xs rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                            @elseif($service->status == 'proses')
                                <span class="px-2 text-xs rounded-full bg-blue-100 text-blue-800">Proses</span>
                            @elseif($service->status == 'selesai')
                                <span class="px-2 text-xs rounded-full bg-green-100 text-green-800">Selesai</span>
                            @endif
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Biaya Jasa</p>
                            <p class="font-semibold">Rp {{ number_format($service->biaya_jasa, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Tambah Spare Part -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Tambah Spare Part</h3>
                    
                    <form action="{{ route('admin.service-details.store', $service->id) }}" method="POST" class="space-y-4">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <!-- Pilih Spare Part -->
                            <div class="md:col-span-2">
                                <label for="spare_part_id" class="block text-sm font-medium text-gray-700 mb-2">
                                    Pilih Spare Part <span class="text-red-500">*</span>
                                </label>
                                <select name="spare_part_id" id="spare_part_id" 
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                                    required>
                                    <option value="">-- Pilih Spare Part --</option>
                                    @foreach($spareParts as $part)
                                        <option value="{{ $part->id }}" data-price="{{ $part->harga_jual }}" data-stock="{{ $part->stok }}">
                                            {{ $part->kode_part }} - {{ $part->nama_part }} 
                                            (Stok: {{ $part->stok }}, Harga: Rp {{ number_format($part->harga_jual, 0, ',', '.') }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Qty -->
                            <div>
                                <label for="qty" class="block text-sm font-medium text-gray-700 mb-2">
                                    Qty <span class="text-red-500">*</span>
                                </label>
                                <input type="number" name="qty" id="qty" value="1" min="1"
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                                    required>
                            </div>
                        </div>

                        <!-- Info Harga -->
                        <div id="price-info" class="bg-blue-50 p-4 rounded hidden">
                            <p class="text-sm text-blue-700">
                                <strong>Harga Satuan:</strong> <span id="price-unit">-</span><br>
                                <strong>Stok Tersedia:</strong> <span id="stock-available">-</span><br>
                                <strong>Subtotal:</strong> <span id="price-subtotal">-</span>
                            </p>
                        </div>

                        <!-- Tombol Submit -->
                        <div class="flex justify-end">
                            <button type="submit" 
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded">
                                + Tambah Spare Part
                            </button>
                        </div>

                    </form>

                </div>
            </div>

            <!-- List Spare Parts yang Sudah Ditambahkan -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Spare Parts yang Digunakan</h3>
                    
                    @if($service->serviceDetails->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kode</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Part</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Qty</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Harga Satuan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Subtotal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($service->serviceDetails as $index => $detail)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">{{ $detail->sparePart->kode_part }}</td>
                                    <td class="px-6 py-4 text-sm">{{ $detail->sparePart->nama_part }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $detail->qty }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <form action="{{ route('admin.service-details.destroy', [$service->id, $detail->id]) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus spare part ini? Stok akan dikembalikan.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                                <tr class="bg-gray-50">
                                    <td colspan="5" class="px-6 py-4 text-right font-bold">Total Biaya Spare Part:</td>
                                    <td class="px-6 py-4 whitespace-nowrap font-bold text-lg text-blue-600">
                                        Rp {{ number_format($service->biaya_sparepart, 0, ',', '.') }}
                                    </td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    @else
                    <p class="text-gray-500 text-center py-8">Belum ada spare part yang digunakan</p>
                    @endif

                </div>
            </div>

            <!-- Summary Biaya -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Ringkasan Biaya</h3>
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span>Biaya Jasa:</span>
                            <span class="font-semibold">Rp {{ number_format($service->biaya_jasa, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Biaya Spare Part:</span>
                            <span class="font-semibold">Rp {{ number_format($service->biaya_sparepart, 0, ',', '.') }}</span>
                        </div>
                        <hr>
                        <div class="flex justify-between text-xl">
                            <span class="font-bold">Total Biaya:</span>
                            <span class="font-bold text-blue-600">Rp {{ number_format($service->biaya_total, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Script untuk hitung harga otomatis -->
    <script>
        const sparePartSelect = document.getElementById('spare_part_id');
        const qtyInput = document.getElementById('qty');
        const priceInfo = document.getElementById('price-info');
        const priceUnit = document.getElementById('price-unit');
        const stockAvailable = document.getElementById('stock-available');
        const priceSubtotal = document.getElementById('price-subtotal');

        function updatePrice() {
            const selectedOption = sparePartSelect.options[sparePartSelect.selectedIndex];
            const price = selectedOption.dataset.price;
            const stock = selectedOption.dataset.stock;
            const qty = qtyInput.value;

            if (price && qty) {
                const subtotal = price * qty;
                priceUnit.textContent = 'Rp ' + parseInt(price).toLocaleString('id-ID');
                stockAvailable.textContent = stock;
                priceSubtotal.textContent = 'Rp ' + subtotal.toLocaleString('id-ID');
                priceInfo.classList.remove('hidden');

                // Warning jika qty melebihi stok
                if (parseInt(qty) > parseInt(stock)) {
                    priceInfo.classList.remove('bg-blue-50');
                    priceInfo.classList.add('bg-red-50');
                    priceSubtotal.parentElement.innerHTML = '<strong>Subtotal:</strong> <span class="text-red-600">Stok tidak cukup!</span>';
                } else {
                    priceInfo.classList.remove('bg-red-50');
                    priceInfo.classList.add('bg-blue-50');
                }
            } else {
                priceInfo.classList.add('hidden');
            }
        }

        sparePartSelect.addEventListener('change', updatePrice);
        qtyInput.addEventListener('input', updatePrice);
    </script>
</x-app-layout>