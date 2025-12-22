<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Spare Part') }}
            </h2>
            <a href="{{ route('admin.spare-parts.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                ← Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    
                    <form action="{{ route('admin.spare-parts.update', $sparePart->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Kode Part -->
                        <div class="mb-4">
                            <label for="kode_part" class="block text-sm font-medium text-gray-700 mb-2">
                                Kode Part <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="kode_part" id="kode_part" value="{{ old('kode_part', $sparePart->kode_part) }}" 
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('kode_part') border-red-500 @enderror" 
                                required>
                            @error('kode_part')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Nama Part -->
                        <div class="mb-4">
                            <label for="nama_part" class="block text-sm font-medium text-gray-700 mb-2">
                                Nama Part <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="nama_part" id="nama_part" value="{{ old('nama_part', $sparePart->nama_part) }}" 
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('nama_part') border-red-500 @enderror" 
                                required>
                            @error('nama_part')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Kategori -->
                        <div class="mb-4">
                            <label for="kategori" class="block text-sm font-medium text-gray-700 mb-2">
                                Kategori
                            </label>
                            <input type="text" name="kategori" id="kategori" value="{{ old('kategori', $sparePart->kategori) }}" 
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <!-- Stok -->
                            <div class="mb-4">
                                <label for="stok" class="block text-sm font-medium text-gray-700 mb-2">
                                    Stok <span class="text-red-500">*</span>
                                </label>
                                <input type="number" name="stok" id="stok" value="{{ old('stok', $sparePart->stok) }}" 
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                                    min="0" required>
                            </div>

                            <!-- Stok Minimum -->
                            <div class="mb-4">
                                <label for="stok_minimum" class="block text-sm font-medium text-gray-700 mb-2">
                                    Stok Minimum <span class="text-red-500">*</span>
                                </label>
                                <input type="number" name="stok_minimum" id="stok_minimum" value="{{ old('stok_minimum', $sparePart->stok_minimum) }}" 
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                                    min="0" required>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <!-- Harga Beli -->
                            <div class="mb-4">
                                <label for="harga_beli" class="block text-sm font-medium text-gray-700 mb-2">
                                    Harga Beli (Rp)
                                </label>
                                <input type="number" name="harga_beli" id="harga_beli" value="{{ old('harga_beli', $sparePart->harga_beli) }}" 
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                                    min="0">
                            </div>

                            <!-- Harga Jual -->
                            <div class="mb-4">
                                <label for="harga_jual" class="block text-sm font-medium text-gray-700 mb-2">
                                    Harga Jual (Rp)
                                </label>
                                <input type="number" name="harga_jual" id="harga_jual" value="{{ old('harga_jual', $sparePart->harga_jual) }}" 
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                                    min="0">
                            </div>
                        </div>

                        <!-- Supplier -->
                        <div class="mb-4">
                            <label for="supplier" class="block text-sm font-medium text-gray-700 mb-2">
                                Supplier
                            </label>
                            <input type="text" name="supplier" id="supplier" value="{{ old('supplier', $sparePart->supplier) }}" 
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>

                        <!-- Keterangan -->
                        <div class="mb-6">
                            <label for="keterangan" class="block text-sm font-medium text-gray-700 mb-2">
                                Keterangan
                            </label>
                            <textarea name="keterangan" id="keterangan" rows="3" 
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('keterangan', $sparePart->keterangan) }}</textarea>
                        </div>

                        <!-- Tombol Submit -->
                        <div class="flex justify-end space-x-3">
                            <a href="{{ route('admin.spare-parts.index') }}" 
                                class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-6 rounded">
                                Batal
                            </a>
                            <button type="submit" 
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded">
                                Update Spare Part
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>