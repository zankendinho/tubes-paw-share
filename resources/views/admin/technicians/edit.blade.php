<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Teknisi') }}
            </h2>
            <a href="{{ route('admin.technicians.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                ← Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    
                    <form action="{{ route('admin.technicians.update', $technician->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Nama -->
                        <div class="mb-4">
                            <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">
                                Nama Lengkap <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="nama" id="nama" value="{{ old('nama', $technician->user->nama) }}" 
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('nama') border-red-500 @enderror" 
                                required>
                            @error('nama')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                Email <span class="text-red-500">*</span>
                            </label>
                            <input type="email" name="email" id="email" value="{{ old('email', $technician->user->email) }}" 
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('email') border-red-500 @enderror" 
                                required>
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Telepon -->
                        <div class="mb-4">
                            <label for="telp" class="block text-sm font-medium text-gray-700 mb-2">
                                Nomor Telepon <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="telp" id="telp" value="{{ old('telp', $technician->user->telp) }}" 
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('telp') border-red-500 @enderror" 
                                required>
                            @error('telp')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Spesialisasi -->
                        <div class="mb-4">
                            <label for="spesialisasi" class="block text-sm font-medium text-gray-700 mb-2">
                                Spesialisasi <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="spesialisasi" id="spesialisasi" value="{{ old('spesialisasi', $technician->spesialisasi) }}" 
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('spesialisasi') border-red-500 @enderror" 
                                required>
                            @error('spesialisasi')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Pengalaman -->
                        <div class="mb-4">
                            <label for="pengalaman" class="block text-sm font-medium text-gray-700 mb-2">
                                Pengalaman (Tahun) <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="pengalaman" id="pengalaman" value="{{ old('pengalaman', $technician->pengalaman) }}" 
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('pengalaman') border-red-500 @enderror" 
                                min="0" required>
                            @error('pengalaman')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <!-- Status Teknisi -->
                            <div class="mb-4">
                                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                                    Status Teknisi <span class="text-red-500">*</span>
                                </label>
                                <select name="status" id="status" 
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('status') border-red-500 @enderror" 
                                    required>
                                    <option value="tersedia" {{ old('status', $technician->status) == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                                    <option value="sibuk" {{ old('status', $technician->status) == 'sibuk' ? 'selected' : '' }}>Sibuk</option>
                                </select>
                                @error('status')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Status Akun -->
                            <div class="mb-4">
                                <label for="user_status" class="block text-sm font-medium text-gray-700 mb-2">
                                    Status Akun <span class="text-red-500">*</span>
                                </label>
                                <select name="user_status" id="user_status" 
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('user_status') border-red-500 @enderror" 
                                    required>
                                    <option value="aktif" {{ old('user_status', $technician->user->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="nonaktif" {{ old('user_status', $technician->user->status) == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                </select>
                                @error('user_status')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Info -->
                        <div class="bg-blue-50 border-l-4 border-blue-400 p-4 mb-6">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-blue-700">
                                        <strong>Username:</strong> {{ $technician->user->username }} (tidak bisa diubah)<br>
                                        <strong>Total Servis:</strong> {{ $technician->total_servis }} servis
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Tombol Submit -->
                        <div class="flex justify-end space-x-3">
                            <a href="{{ route('admin.technicians.index') }}" 
                                class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-6 rounded">
                                Batal
                            </a>
                            <button type="submit" 
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded">
                                Update Teknisi
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>