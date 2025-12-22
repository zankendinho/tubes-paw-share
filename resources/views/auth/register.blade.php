<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="text-3xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
            Buat Akun Baru
        </h2>
        <p class="mt-2 text-gray-600 text-sm">Daftar untuk menggunakan layanan kami</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <!-- Nama Lengkap -->
        <div>
            <x-input-label for="nama" :value="__('Nama Lengkap')" />
            <x-text-input id="nama" class="block mt-2 w-full" type="text" name="nama" :value="old('nama')" required autofocus autocomplete="name" placeholder="Masukkan nama lengkap" />
            <x-input-error :messages="$errors->get('nama')" class="mt-2" />
        </div>

        <!-- Username -->
        <div>
            <x-input-label for="username" :value="__('Username')" />
            <x-text-input id="username" class="block mt-2 w-full" type="text" name="username" :value="old('username')" required autocomplete="username" placeholder="Masukkan username" />
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-2 w-full" type="email" name="email" :value="old('email')" required autocomplete="email" placeholder="nama@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Nomor Telepon (TAMBAHAN BARU) -->
        <div>
            <x-input-label for="telp" :value="__('Nomor Telepon')" />
            <x-text-input id="telp" class="block mt-2 w-full" type="text" name="telp" :value="old('telp')" required autocomplete="tel" placeholder="08xxxxxxxxxx" />
            <x-input-error :messages="$errors->get('telp')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-2 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" 
                            placeholder="Minimal 8 karakter" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" />
            <x-text-input id="password_confirmation" class="block mt-2 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" 
                            placeholder="Ulangi password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Submit Button -->
        <div class="pt-2">
            <x-primary-button class="w-full justify-center">
                Daftar
            </x-primary-button>
        </div>

        <!-- Login Link -->
        <div class="text-center">
            <span class="text-sm text-gray-600">Sudah punya akun?</span>
            <a href="{{ route('login') }}" class="text-sm text-indigo-600 hover:text-indigo-800 font-medium ml-1">
                Masuk di sini
            </a>
        </div>
    </form>
</x-guest-layout>