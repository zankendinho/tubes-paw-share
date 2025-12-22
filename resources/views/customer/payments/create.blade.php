<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Upload Bukti Pembayaran') }}
            </h2>
            <a href="{{ route('customer.services.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                ← Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Info Servis -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Detail Servis</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-500">Kode Servis</p>
                            <p class="font-bold text-xl">{{ $service->kode_servis }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Status</p>
                            <span class="px-3 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-800">Selesai</span>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Perangkat</p>
                            <p class="font-semibold">{{ $service->device->kategori }} - {{ $service->device->merk }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Total Biaya</p>
                            <p class="text-2xl font-bold text-blue-600">Rp {{ number_format($service->biaya_total, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Rincian Biaya -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Rincian Biaya</h3>
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
                            <span class="font-bold">Total yang Harus Dibayar:</span>
                            <span class="font-bold text-blue-600">Rp {{ number_format($service->biaya_total, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Informasi Rekening -->
            <div class="bg-blue-50 border-l-4 border-blue-400 p-4 mb-6">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-semibold text-blue-800">Informasi Transfer Bank</h3>
                        <div class="mt-2 text-sm text-blue-700 space-y-1">
                            <p><strong>Bank BCA</strong></p>
                            <p>No. Rekening: <strong class="text-lg">1234567890</strong></p>
                            <p>Atas Nama: <strong>SIMSE Service Center</strong></p>
                            <hr class="my-2 border-blue-300">
                            <p><strong>Bank Mandiri</strong></p>
                            <p>No. Rekening: <strong class="text-lg">0987654321</strong></p>
                            <p>Atas Nama: <strong>SIMSE Service Center</strong></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Upload -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Upload Bukti Transfer</h3>
                    
                    <form action="{{ route('customer.payments.store', $service->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Jumlah Bayar -->
                        <div class="mb-4">
                            <label for="jumlah_bayar" class="block text-sm font-medium text-gray-700 mb-2">
                                Jumlah yang Dibayar (Rp) <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="jumlah_bayar" id="jumlah_bayar" value="{{ old('jumlah_bayar', $service->biaya_total) }}" 
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('jumlah_bayar') border-red-500 @enderror" 
                                min="0" required>
                            @error('jumlah_bayar')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Metode Pembayaran -->
                        <div class="mb-4">
                            <label for="metode_pembayaran" class="block text-sm font-medium text-gray-700 mb-2">
                                Metode Pembayaran <span class="text-red-500">*</span>
                            </label>
                            <select name="metode_pembayaran" id="metode_pembayaran" 
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('metode_pembayaran') border-red-500 @enderror" 
                                required>
                                <option value="transfer_bank" {{ old('metode_pembayaran') == 'transfer_bank' ? 'selected' : '' }}>Transfer Bank</option>
                                <option value="cash" {{ old('metode_pembayaran') == 'cash' ? 'selected' : '' }}>Cash</option>
                                <option value="e-wallet" {{ old('metode_pembayaran') == 'e-wallet' ? 'selected' : '' }}>E-Wallet (OVO/GoPay/DANA)</option>
                            </select>
                            @error('metode_pembayaran')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Upload Bukti Transfer -->
                        <div class="mb-4">
                            <label for="bukti_transfer" class="block text-sm font-medium text-gray-700 mb-2">
                                Upload Bukti Transfer <span class="text-red-500">*</span>
                            </label>
                            <input type="file" name="bukti_transfer" id="bukti_transfer" accept="image/*" 
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('bukti_transfer') border-red-500 @enderror" 
                                required onchange="previewImage(event)">
                            <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG (Max: 2MB)</p>
                            @error('bukti_transfer')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror

                            <!-- Preview Image -->
                            <div id="preview-container" class="mt-4 hidden">
                                <p class="text-sm font-medium text-gray-700 mb-2">Preview:</p>
                                <img id="preview-image" src="" alt="Preview" class="max-w-md border rounded-lg shadow-sm">
                            </div>
                        </div>

                        <!-- Keterangan -->
                        <div class="mb-6">
                            <label for="keterangan" class="block text-sm font-medium text-gray-700 mb-2">
                                Keterangan (Opsional)
                            </label>
                            <textarea name="keterangan" id="keterangan" rows="3" 
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                                placeholder="Contoh: Transfer via BCA a.n. Ahmad Rizki">{{ old('keterangan') }}</textarea>
                        </div>

                        <!-- Warning -->
                        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-yellow-700">
                                        <strong>Perhatian:</strong> Pastikan bukti transfer jelas dan terbaca. Admin akan memverifikasi pembayaran Anda dalam 1x24 jam.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Tombol Submit -->
                        <div class="flex justify-end space-x-3">
                            <a href="{{ route('customer.services.index') }}" 
                                class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-6 rounded">
                                Batal
                            </a>
                            <button type="submit" 
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded">
                                Upload & Konfirmasi Pembayaran
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

    <!-- Script Preview Image -->
    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            const previewContainer = document.getElementById('preview-container');
            const previewImage = document.getElementById('preview-image');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            } else {
                previewContainer.classList.add('hidden');
            }
        }
    </script>
</x-app-layout>