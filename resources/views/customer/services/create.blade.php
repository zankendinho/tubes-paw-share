<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ajukan Servis Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    @if (session('success'))
                        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('customer.services.store') }}" class="space-y-6">
                        @csrf

                        <!-- Pilih Device -->
                        <div>
                            <label for="device_id" class="block text-sm font-medium text-gray-700 mb-2">
                                Device yang akan diservis <span class="text-red-500">*</span>
                            </label>
                            <select id="device_id" name="device_id" required
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('device_id') border-red-500 @enderror">
                                <option value="">-- Pilih Device --</option>
                                @foreach ($devices as $device)
                                    <option value="{{ $device->id }}" {{ old('device_id') == $device->id ? 'selected' : '' }}>
                                        {{ $device->kategori }} - {{ $device->merk }} {{ $device->model }}
                                        @if($device->serial_number)
                                            (SN: {{ $device->serial_number }})
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                            @error('device_id')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-sm text-gray-500">
                                Belum ada device? 
                                <a href="{{ route('customer.devices.create') }}" class="text-indigo-600 hover:text-indigo-800 underline">
                                    Tambahkan device baru
                                </a>
                            </p>
                        </div>

                        <!-- Keluhan -->
                        <div>
                            <label for="keluhan" class="block text-sm font-medium text-gray-700 mb-2">
                                Keluhan / Masalah <span class="text-red-500">*</span>
                            </label>
                            <textarea id="keluhan" name="keluhan" rows="5" required
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('keluhan') border-red-500 @enderror"
                                placeholder="Jelaskan masalah yang terjadi pada device Anda secara detail...">{{ old('keluhan') }}</textarea>
                            @error('keluhan')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-sm text-gray-500">Minimal 10 karakter. Semakin detail, semakin memudahkan teknisi.</p>
                        </div>

                        <!-- Prioritas -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Prioritas Servis <span class="text-red-500">*</span>
                            </label>
                            <div class="space-y-2">
                                <div class="flex items-center">
                                    <input id="prioritas_normal" type="radio" name="prioritas" value="normal" 
                                        {{ old('prioritas', 'normal') == 'normal' ? 'checked' : '' }}
                                        class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300">
                                    <label for="prioritas_normal" class="ml-3 block text-sm text-gray-700">
                                        Normal - Pengerjaan sesuai antrian
                                    </label>
                                </div>
                                <div class="flex items-center">
                                    <input id="prioritas_urgent" type="radio" name="prioritas" value="urgent"
                                        {{ old('prioritas') == 'urgent' ? 'checked' : '' }}
                                        class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300">
                                    <label for="prioritas_urgent" class="ml-3 block text-sm text-gray-700">
                                        Urgent - Diprioritaskan (biaya tambahan mungkin berlaku)
                                    </label>
                                </div>
                            </div>
                            @error('prioritas')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror>
                        </div>

                        <!-- Info Box -->
                        <div class="bg-blue-50 border border-blue-200 rounded-md p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div class="ml-3 flex-1">
                                    <h3 class="text-sm font-medium text-blue-800">Informasi Penting</h3>
                                    <div class="mt-2 text-sm text-blue-700">
                                        <ul class="list-disc list-inside space-y-1">
                                            <li>Estimasi biaya akan diberikan setelah diagnosa awal oleh teknisi</li>
                                            <li>Anda akan dihubungi untuk konfirmasi sebelum perbaikan dimulai</li>
                                            <li>Status servis dapat dipantau melalui dashboard Anda</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="flex items-center justify-end space-x-3 pt-4">
                            <a href="{{ route('customer.services.index') }}" 
                                class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold rounded-md transition">
                                Batal
                            </a>
                            <button type="submit" 
                                class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-md transition">
                                Ajukan Servis
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>