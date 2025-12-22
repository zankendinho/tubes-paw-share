<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Servis') }} - {{ $service->kode_servis }}
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
                    
                    <form action="{{ route('admin.services.update', $service->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Customer -->
                        <div class="mb-4">
                            <label for="customer_id" class="block text-sm font-medium text-gray-700 mb-2">
                                Customer <span class="text-red-500">*</span>
                            </label>
                            <select name="customer_id" id="customer_id" 
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('customer_id') border-red-500 @enderror" 
                                required>
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}" {{ old('customer_id', $service->customer_id) == $customer->id ? 'selected' : '' }}>
                                        {{ $customer->nama }} - {{ $customer->telp }}
                                    </option>
                                @endforeach
                            </select>
                            @error('customer_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Device -->
                        <div class="mb-4">
                            <label for="device_id" class="block text-sm font-medium text-gray-700 mb-2">
                                Perangkat <span class="text-red-500">*</span>
                            </label>
                            <select name="device_id" id="device_id" 
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('device_id') border-red-500 @enderror" 
                                required>
                                @foreach($devices as $device)
                                    <option value="{{ $device->id }}" {{ old('device_id', $service->device_id) == $device->id ? 'selected' : '' }}>
                                        {{ $device->kategori }} - {{ $device->merk }} {{ $device->model }}
                                    </option>
                                @endforeach
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
                                required>{{ old('keluhan', $service->keluhan) }}</textarea>
                            @error('keluhan')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Diagnosa -->
                        <div class="mb-4">
                            <label for="diagnosa" class="block text-sm font-medium text-gray-700 mb-2">
                                Diagnosa
                            </label>
                            <textarea name="diagnosa" id="diagnosa" rows="3" 
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('diagnosa') border-red-500 @enderror">{{ old('diagnosa', $service->diagnosa) }}</textarea>
                            @error('diagnosa')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tindakan -->
                        <div class="mb-4">
                            <label for="tindakan" class="block text-sm font-medium text-gray-700 mb-2">
                                Tindakan
                            </label>
                            <textarea name="tindakan" id="tindakan" rows="3" 
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('tindakan') border-red-500 @enderror">{{ old('tindakan', $service->tindakan) }}</textarea>
                            @error('tindakan')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <!-- Tanggal Masuk -->
                            <div class="mb-4">
                                <label for="tanggal_masuk" class="block text-sm font-medium text-gray-700 mb-2">
                                    Tanggal Masuk <span class="text-red-500">*</span>
                                </label>
                                <input type="date" name="tanggal_masuk" id="tanggal_masuk" value="{{ old('tanggal_masuk', $service->tanggal_masuk?->format('Y-m-d')) }}" 
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                            </div>

                            <!-- Tanggal Mulai -->
                            <div class="mb-4">
                                <label for="tanggal_mulai" class="block text-sm font-medium text-gray-700 mb-2">
                                    Tanggal Mulai
                                </label>
                                <input type="date" name="tanggal_mulai" id="tanggal_mulai" value="{{ old('tanggal_mulai', $service->tanggal_mulai?->format('Y-m-d')) }}" 
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <!-- Tanggal Estimasi Selesai -->
                            <div class="mb-4">
                                <label for="tanggal_estimasi_selesai" class="block text-sm font-medium text-gray-700 mb-2">
                                    Estimasi Selesai
                                </label>
                                <input type="date" name="tanggal_estimasi_selesai" id="tanggal_estimasi_selesai" value="{{ old('tanggal_estimasi_selesai', $service->tanggal_estimasi_selesai?->format('Y-m-d')) }}" 
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <!-- Tanggal Selesai -->
                            <div class="mb-4">
                                <label for="tanggal_selesai" class="block text-sm font-medium text-gray-700 mb-2">
                                    Tanggal Selesai
                                </label>
                                <input type="date" name="tanggal_selesai" id="tanggal_selesai" value="{{ old('tanggal_selesai', $service->tanggal_selesai?->format('Y-m-d')) }}" 
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>
                        </div>

                        <!-- Teknisi -->
                        <div class="mb-4">
                            <label for="technician_id" class="block text-sm font-medium text-gray-700 mb-2">
                                Teknisi
                            </label>
                            <select name="technician_id" id="technician_id" 
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">-- Belum ditentukan --</option>
                                @foreach($technicians as $tech)
                                    <option value="{{ $tech->id }}" {{ old('technician_id', $service->technician_id) == $tech->id ? 'selected' : '' }}>
                                        {{ $tech->user->nama }} - {{ $tech->spesialisasi }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            

                            <!-- Biaya Jasa -->
                            <div class="mb-4">
                                <label for="biaya_jasa" class="block text-sm font-medium text-gray-700 mb-2">
                                    Biaya Jasa (Rp)
                                </label>
                                <input type="number" name="biaya_jasa" id="biaya_jasa" value="{{ old('biaya_jasa', $service->biaya_jasa) }}" 
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500" min="0">
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <!-- Status -->
                            <div class="mb-4">
                                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                                    Status <span class="text-red-500">*</span>
                                </label>
                                <select name="status" id="status" 
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                                    <option value="pending" {{ old('status', $service->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="proses" {{ old('status', $service->status) == 'proses' ? 'selected' : '' }}>Proses</option>
                                    <option value="selesai" {{ old('status', $service->status) == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                    <option value="diambil" {{ old('status', $service->status) == 'diambil' ? 'selected' : '' }}>Diambil</option>
                                    <option value="batal" {{ old('status', $service->status) == 'batal' ? 'selected' : '' }}>Batal</option>
                                </select>
                            </div>

                            <!-- Prioritas -->
                            <div class="mb-4">
                                <label for="prioritas" class="block text-sm font-medium text-gray-700 mb-2">
                                    Prioritas <span class="text-red-500">*</span>
                                </label>
                                <select name="prioritas" id="prioritas" 
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                                    <option value="normal" {{ old('prioritas', $service->prioritas) == 'normal' ? 'selected' : '' }}>Normal</option>
                                    <option value="urgent" {{ old('prioritas', $service->prioritas) == 'urgent' ? 'selected' : '' }}>Urgent</option>
                                </select>
                            </div>
                        </div>

                        <!-- Catatan -->
                        <div class="mb-6">
                            <label for="catatan" class="block text-sm font-medium text-gray-700 mb-2">
                                Catatan
                            </label>
                            <textarea name="catatan" id="catatan" rows="3" 
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('catatan', $service->catatan) }}</textarea>
                        </div>

                        <!-- Info Biaya -->
                        <div class="bg-blue-50 border-l-4 border-blue-400 p-4 mb-6">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-blue-700">
                                        <strong>Biaya Sparepart:</strong> Rp {{ number_format($service->biaya_sparepart, 0, ',', '.') }}<br>
                                        <strong>Biaya Total Saat Ini:</strong> Rp {{ number_format($service->biaya_total, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Tombol Submit -->
                        <div class="flex justify-end space-x-3">
                            <a href="{{ route('admin.services.index') }}" 
                                class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-6 rounded">
                                Batal
                            </a>
                            <button type="submit" 
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded">
                                Update Servis
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
            
            deviceSelect.innerHTML = '<option value="">Loading...</option>';
            deviceSelect.disabled = true;
            
            if (customerId) {
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
                    });
            }
        });
    </script>
</x-app-layout>