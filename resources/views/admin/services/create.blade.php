<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Tambah Servis Baru') }}
            </h2>
            <a href="{{ route('admin.services.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                ← Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    
                    <form action="{{ route('admin.services.store') }}" method="POST">
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

                        <!-- Device (akan diisi otomatis via AJAX) -->
                        <div class="mb-4">
                            <label for="device_id" class="block text-sm font-medium text-gray-700 mb-2">
                                Pilih Perangkat <span class="text-red-500">*</span>
                            </label>
                            <select name="device_id" id="device_id" 
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('device_id') border-red-500 @enderror" 
                                required disabled>
                                <option value="">-- Pilih Customer dulu --</option>
                            </select>
                            @error('device_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Keluhan -->
                        <div class="mb-4">
                            <label for="keluhan" class="block text-sm font-medium text-gray-700 mb-2">
                                Keluhan <span class="text-red-500">*</span>
                            </label>
                            <textarea name="keluhan" id="keluhan" rows="3" 
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('keluhan') border-red-500 @enderror" 
                                placeholder="Jelaskan keluhan/masalah perangkat" required>{{ old('keluhan') }}</textarea>
                            @error('keluhan')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tanggal Masuk -->
                        <div class="mb-4">
                            <label for="tanggal_masuk" class="block text-sm font-medium text-gray-700 mb-2">
                                Tanggal Masuk <span class="text-red-500">*</span>
                            </label>
                            <input type="date" name="tanggal_masuk" id="tanggal_masuk" value="{{ old('tanggal_masuk', date('Y-m-d')) }}" 
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('tanggal_masuk') border-red-500 @enderror" 
                                required>
                            @error('tanggal_masuk')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Prioritas -->
                        <div class="mb-4">
                            <label for="prioritas" class="block text-sm font-medium text-gray-700 mb-2">
                                Prioritas <span class="text-red-500">*</span>
                            </label>
                            <select name="prioritas" id="prioritas" 
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('prioritas') border-red-500 @enderror" 
                                required>
                                <option value="normal" {{ old('prioritas') == 'normal' ? 'selected' : '' }}>Normal</option>
                                <option value="urgent" {{ old('prioritas') == 'urgent' ? 'selected' : '' }}>Urgent</option>
                            </select>
                            @error('prioritas')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Teknisi (Optional) -->
                        <div class="mb-4">
                            <label for="technician_id" class="block text-sm font-medium text-gray-700 mb-2">
                                Assign Teknisi (Opsional)
                            </label>
                            <select name="technician_id" id="technician_id" 
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">-- Belum ditentukan --</option>
                                @foreach($technicians as $tech)
                                    <option value="{{ $tech->id }}" {{ old('technician_id') == $tech->id ? 'selected' : '' }}>
                                        {{ $tech->user->nama }} - {{ $tech->spesialisasi }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Estimasi Biaya -->
                        <div class="mb-6">
                            <label for="estimasi_biaya" class="block text-sm font-medium text-gray-700 mb-2">
                                Estimasi Biaya (Rp)
                            </label>
                            <input type="number" name="estimasi_biaya" id="estimasi_biaya" value="{{ old('estimasi_biaya', 0) }}" 
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('estimasi_biaya') border-red-500 @enderror" 
                                min="0" placeholder="Contoh: 500000">
                            @error('estimasi_biaya')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tombol Submit -->
                        <div class="flex justify-end space-x-3">
                            <a href="{{ route('admin.services.index') }}" 
                                class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-6 rounded">
                                Batal
                            </a>
                            <button type="submit" 
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded">
                                Simpan Servis
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- Script AJAX untuk load devices berdasarkan customer -->
    <script>
        document.getElementById('customer_id').addEventListener('change', function() {
            const customerId = this.value;
            const deviceSelect = document.getElementById('device_id');
            
            // Reset dropdown device
            deviceSelect.innerHTML = '<option value="">Loading...</option>';
            deviceSelect.disabled = true;
            
            if (customerId) {
                // Fetch devices via AJAX
                fetch(`/admin/get-devices/${customerId}`)
                    .then(response => response.json())
                    .then(data => {
                        deviceSelect.innerHTML = '<option value="">-- Pilih Perangkat --</option>';
                        
                        if (data.length > 0) {
                            data.forEach(device => {
                                const option = document.createElement('option');
                                option.value = device.id;
                                option.textContent = `${device.kategori} - ${device.merk} ${device.model || ''}`;
                                deviceSelect.appendChild(option);
                            });
                            deviceSelect.disabled = false;
                        } else {
                            deviceSelect.innerHTML = '<option value="">Customer belum punya perangkat</option>';
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        deviceSelect.innerHTML = '<option value="">Error loading devices</option>';
                    });
            } else {
                deviceSelect.innerHTML = '<option value="">-- Pilih Customer dulu --</option>';
            }
        });
    </script>
</x-app-layout>