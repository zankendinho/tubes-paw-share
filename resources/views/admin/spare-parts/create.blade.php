<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Tambah Spare Part Baru') }}
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
                    
                    <form action="{{ route('admin.spare-parts.store') }}" method="POST">
                        @csrf

                        <!-- Kode Part -->
                        <div class="mb-4">
                            <label for="kode_part" class="block text-sm font-medium text-gray-700 mb-2">
                                Kode Part <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="kode_part" id="kode_part" value="{{ old('kode_part') }}" 
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('kode_part') border-red-500 @enderror" 
                                placeholder="Contoh: SP001" required>
                            @error('kode_part')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Nama Part -->
                        <div class="mb-4">
                            <label for="nama_part" class="block text-sm font-medium text-gray-700 mb-2">
                                Nama Part <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="nama_part" id="nama_part" value="{{ old('nama_part') }}" 
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('nama_part') border-red-500 @enderror" 
                                placeholder="Contoh: Kapasitor 100uF 450V" required>
                            @error('nama_part')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Kategori -->
                        <div class="mb-4">
                            <label for="kategori" class="block text-sm font-medium text-gray-700 mb-2">
                                Kategori
                            </label>
                            <input type="text" name="kategori" id="kategori" value="{{ old('kategori') }}" 
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('kategori') border-red-500 @enderror" 
                                placeholder="Contoh: Elektronik, Display, Memory">
                            @error('kategori')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <!-- Stok -->
                            <div class="mb-4">
                                <label for="stok" class="block text-sm font-medium text-gray-700 mb-2">
                                    Stok <span class="text-red-500">*</span>
                                </label>
                                <input type="number" name="stok" id="stok" value="{{ old('stok', 0) }}" 
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('stok') border-red-500 @enderror" 
                                    min="0" required>
                                @error('stok')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Stok Minimum -->
                            <div class="mb-4">
                                <label for="stok_minimum" class="block text-sm font-medium text-gray-700 mb-2">
                                    Stok Minimum <span class="text-red-500">*</span>
                                </label>
                                <input type="number" name="stok_minimum" id="stok_minimum" value="{{ old('stok_minimum', 5) }}" 
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('stok_minimum') border-red-500 @enderror" 
                                    min="0" required>
                                @error('stok_minimum')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <!-- Harga Beli -->
                            <div class="mb-4">
                                <label for="harga_beli" class="block text-sm font-medium text-gray-700 mb-2">
                                    Harga Beli (Rp)
                                </label>
                                <input type="number" name="harga_beli" id="harga_beli" value="{{ old('harga_beli') }}" 
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('harga_beli') border-red-500 @enderror" 
                                    min="0" placeholder="0">
                                @error('harga_beli')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Harga Jual -->
                            <div class="mb-4">
                                <label for="harga_jual" class="block text-sm font-medium text-gray-700 mb-2">
                                    Harga Jual (Rp)
                                </label>
                                <input type="number" name="harga_jual" id="harga_jual" value="{{ old('harga_jual') }}" 
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('harga_jual') border-red-500 @enderror" 
                                    min="0" placeholder="0">
                                @error('harga_jual')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Supplier -->
                        <div class="mb-4">
                            <label for="supplier" class="block text-sm font-medium text-gray-700 mb-2">
                                Supplier
                            </label>
                            <input type="text" name="supplier" id="supplier" value="{{ old('supplier') }}" 
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('supplier') border-red-500 @enderror" 
                                placeholder="Contoh: PT. Elektronik Jaya">
                            @error('supplier')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Keterangan -->
                        <div class="mb-6">
                            <label for="keterangan" class="block text-sm font-medium text-gray-700 mb-2">
                                Keterangan
                            </label>
                            <textarea name="keterangan" id="keterangan" rows="3" 
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('keterangan') border-red-500 @enderror" 
                                placeholder="Keterangan tambahan tentang spare part">{{ old('keterangan') }}</textarea>
                            @error('keterangan')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tombol Submit -->
                        <div class="flex justify-end space-x-3">
                            <a href="{{ route('admin.spare-parts.index') }}" 
                                class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-6 rounded">
                                Batal
                            </a>
                            <button type="submit" 
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded">
                                Simpan Spare Part
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>