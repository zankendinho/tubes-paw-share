<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Tambah Perangkat Baru') }}
            </h2>
            <a href="{{ route('admin.devices.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                ← Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    
                    <form action="{{ route('admin.devices.store') }}" method="POST">
                        @csrf

                        <!-- Customer -->
                        <div class="mb-4">
                            <label for="customer_id" class="block text-sm font-medium text-gray-700 mb-2">
                                Pilih Customer <span class="text-red-500">*</span>
                            </label>
                            <select name="customer_id" id="customer_id" 
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('customer_id') border-red-500 @enderror" 
                                required>
                                <option value="">-- Pilih Customer --</option>
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                        {{ $customer->nama }} - {{ $customer->telp }}
                                    </option>
                                @endforeach
                            </select>
                            @error('customer_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Kategori -->
                        <div class="mb-4">
                            <label for="kategori" class="block text-sm font-medium text-gray-700 mb-2">
                                Kategori Perangkat <span class="text-red-500">*</span>
                            </label>
                            <select name="kategori" id="kategori" 
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('kategori') border-red-500 @enderror" 
                                required>
                                <option value="">-- Pilih Kategori --</option>
                                <option value="TV" {{ old('kategori') == 'TV' ? 'selected' : '' }}>TV</option>
                                <option value="AC" {{ old('kategori') == 'AC' ? 'selected' : '' }}>AC</option>
                                <option value="Laptop" {{ old('kategori') == 'Laptop' ? 'selected' : '' }}>Laptop</option>
                                <option value="PC" {{ old('kategori') == 'PC' ? 'selected' : '' }}>PC</option>
                                <option value="Kulkas" {{ old('kategori') == 'Kulkas' ? 'selected' : '' }}>Kulkas</option>
                                <option value="Mesin Cuci" {{ old('kategori') == 'Mesin Cuci' ? 'selected' : '' }}>Mesin Cuci</option>
                                <option value="Lainnya" {{ old('kategori') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            @error('kategori')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Merk -->
                        <div class="mb-4">
                            <label for="merk" class="block text-sm font-medium text-gray-700 mb-2">
                                Merk <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="merk" id="merk" value="{{ old('merk') }}" 
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('merk') border-red-500 @enderror" 
                                placeholder="Contoh: Samsung, LG, Asus" required>
                            @error('merk')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Model -->
                        <div class="mb-4">
                            <label for="model" class="block text-sm font-medium text-gray-700 mb-2">
                                Model
                            </label>
                            <input type="text" name="model" id="model" value="{{ old('model') }}" 
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('model') border-red-500 @enderror" 
                                placeholder="Contoh: UA43T6500, VivoBook A412DA">
                            @error('model')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Serial Number -->
                        <div class="mb-4">
                            <label for="serial_number" class="block text-sm font-medium text-gray-700 mb-2">
                                Serial Number
                            </label>
                            <input type="text" name="serial_number" id="serial_number" value="{{ old('serial_number') }}" 
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('serial_number') border-red-500 @enderror" 
                                placeholder="Contoh: SN001234">
                            @error('serial_number')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tahun Beli -->
                        <div class="mb-4">
                            <label for="tahun_beli" class="block text-sm font-medium text-gray-700 mb-2">
                                Tahun Pembelian
                            </label>
                            <input type="number" name="tahun_beli" id="tahun_beli" value="{{ old('tahun_beli') }}" 
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('tahun_beli') border-red-500 @enderror" 
                                placeholder="Contoh: 2020" min="1900" max="{{ date('Y') }}">
                            @error('tahun_beli')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Kondisi -->
                        <div class="mb-6">
                            <label for="kondisi" class="block text-sm font-medium text-gray-700 mb-2">
                                Kondisi Perangkat
                            </label>
                            <textarea name="kondisi" id="kondisi" rows="3" 
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('kondisi') border-red-500 @enderror" 
                                placeholder="Contoh: Baik, pemakaian normal">{{ old('kondisi') }}</textarea>
                            @error('kondisi')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tombol Submit -->
                        <div class="flex justify-end space-x-3">
                            <a href="{{ route('admin.devices.index') }}" 
                                class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-6 rounded">
                                Batal
                            </a>
                            <button type="submit" 
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded">
                                Simpan Perangkat
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>