<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Perangkat Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    @if (session('error'))
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('customer.devices.store') }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        <!-- Kategori -->
                        <div>
                            <label for="kategori" class="block text-sm font-medium text-gray-700 mb-2">
                                Kategori Device <span class="text-red-500">*</span>
                            </label>
                            <select id="kategori" name="kategori" required
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('kategori') border-red-500 @enderror">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach ($kategoriOptions as $kat)
                                    <option value="{{ $kat }}" {{ old('kategori') == $kat ? 'selected' : '' }}>
                                        {{ $kat }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kategori')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Merk -->
                        <div>
                            <label for="merk" class="block text-sm font-medium text-gray-700 mb-2">
                                Merk <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="merk" name="merk" value="{{ old('merk') }}" required
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('merk') border-red-500 @enderror"
                                placeholder="Contoh: Samsung, LG, Sony">
                            @error('merk')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Model -->
                        <div>
                            <label for="model" class="block text-sm font-medium text-gray-700 mb-2">
                                Model
                            </label>
                            <input type="text" id="model" name="model" value="{{ old('model') }}"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('model') border-red-500 @enderror"
                                placeholder="Contoh: UA43T6500">
                            @error('model')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Serial Number -->
                        <div>
                            <label for="serial_number" class="block text-sm font-medium text-gray-700 mb-2">
                                Serial Number
                            </label>
                            <input type="text" id="serial_number" name="serial_number" value="{{ old('serial_number') }}"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('serial_number') border-red-500 @enderror"
                                placeholder="Contoh: SN001234">
                            @error('serial_number')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tahun Beli -->
                        <div>
                            <label for="tahun_beli" class="block text-sm font-medium text-gray-700 mb-2">
                                Tahun Pembelian
                            </label>
                            <input type="number" id="tahun_beli" name="tahun_beli" value="{{ old('tahun_beli') }}"
                                min="1900" max="{{ date('Y') + 1 }}"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('tahun_beli') border-red-500 @enderror"
                                placeholder="{{ date('Y') }}">
                            @error('tahun_beli')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Upload Foto Device (BARU) -->
                        <div>
                            <label for="foto" class="block text-sm font-medium text-gray-700 mb-2">
                                Foto Device
                            </label>
                            <div class="mt-1 flex items-center space-x-4">
                                <div class="flex-1">
                                    <input 
                                        id="foto" 
                                        type="file" 
                                        name="foto" 
                                        accept="image/*"
                                        onchange="previewImage(event)"
                                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none focus:border-indigo-500 @error('foto') border-red-500 @enderror"
                                    />
                                    <p class="mt-1 text-xs text-gray-500">Upload foto device (JPG, PNG, max 2MB)</p>
                                    @error('foto')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            
                            <!-- Preview Image -->
                            <div id="imagePreview" class="mt-4 hidden">
                                <p class="text-sm font-medium text-gray-700 mb-2">Preview:</p>
                                <img id="preview" class="w-48 h-48 object-cover rounded-lg border-2 border-gray-300 shadow-sm" alt="Preview">
                            </div>
                        </div>

                        <!-- Kondisi -->
                        <div>
                            <label for="kondisi" class="block text-sm font-medium text-gray-700 mb-2">
                                Kondisi Device
                            </label>
                            <textarea id="kondisi" name="kondisi" rows="3"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('kondisi') border-red-500 @enderror"
                                placeholder="Jelaskan kondisi device (opsional)">{{ old('kondisi') }}</textarea>
                            @error('kondisi')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Buttons -->
                        <div class="flex items-center justify-end space-x-3 pt-4">
                            <a href="{{ route('customer.devices.index') }}" 
                                class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold rounded-md transition">
                                Batal
                            </a>
                            <button type="submit" 
                                class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-md transition">
                                Simpan Device
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript untuk Preview Image -->
    <script>
    function previewImage(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('preview');
        const previewContainer = document.getElementById('imagePreview');
        
        if (file) {
            // Validasi ukuran file (max 2MB)
            if (file.size > 2 * 1024 * 1024) {
                alert('Ukuran file terlalu besar! Maksimal 2MB.');
                event.target.value = '';
                previewContainer.classList.add('hidden');
                return;
            }
            
            // Validasi tipe file
            if (!file.type.match('image.*')) {
                alert('File harus berupa gambar!');
                event.target.value = '';
                previewContainer.classList.add('hidden');
                return;
            }
            
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                previewContainer.classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        } else {
            previewContainer.classList.add('hidden');
        }
    }
    </script>
</x-app-layout>