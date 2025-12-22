<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Pembayaran') }}
            </h2>
            <a href="{{ route('admin.payments.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                ← Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Info Servis -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Informasi Servis</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <p class="text-sm text-gray-500">Kode Servis</p>
                            <p class="font-bold text-xl">
                                <a href="{{ route('admin.services.show', $payment->service->id) }}" class="text-blue-600 hover:text-blue-900">
                                    {{ $payment->service->kode_servis }}
                                </a>
                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Customer</p>
                            <p class="font-semibold">{{ $payment->customer->nama }}</p>
                            <p class="text-sm text-gray-500">{{ $payment->customer->telp }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Perangkat</p>
                            <p class="font-semibold">{{ $payment->service->device->kategori }} - {{ $payment->service->device->merk }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detail Pembayaran -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Detail Pembayaran</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <p class="text-sm text-gray-500">Jumlah Dibayar</p>
                            <p class="text-2xl font-bold text-blue-600">Rp {{ number_format($payment->jumlah_bayar, 0, ',', '.') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Total Biaya Servis</p>
                            <p class="text-xl font-semibold">Rp {{ number_format($payment->service->biaya_total, 0, ',', '.') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Metode Pembayaran</p>
                            <p class="font-semibold">
                                @if($payment->metode_pembayaran == 'transfer_bank')
                                    Transfer Bank
                                @elseif($payment->metode_pembayaran == 'cash')
                                    Cash
                                @else
                                    E-Wallet
                                @endif
                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Tanggal Upload</p>
                            <p class="font-semibold">{{ $payment->tanggal_upload?->format('d M Y H:i') ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Status</p>
                            @if($payment->status == 'pending')
                                <span class="px-3 py-1 inline-flex text-sm font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    Pending
                                </span>
                            @elseif($payment->status == 'verified')
                                <span class="px-3 py-1 inline-flex text-sm font-semibold rounded-full bg-green-100 text-green-800">
                                    Verified
                                </span>
                            @else
                                <span class="px-3 py-1 inline-flex text-sm font-semibold rounded-full bg-red-100 text-red-800">
                                    Rejected
                                </span>
                            @endif
                        </div>
                        @if($payment->keterangan)
                        <div>
                            <p class="text-sm text-gray-500">Keterangan</p>
                            <p class="font-semibold">{{ $payment->keterangan }}</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Bukti Transfer -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Bukti Transfer</h3>
                    @if($payment->bukti_transfer)
                        <img src="{{ asset('storage/payments/' . $payment->bukti_transfer) }}"
                             alt="Bukti Transfer" 
                             class="max-w-2xl border rounded-lg shadow-lg cursor-pointer"
                             onclick="window.open(this.src, '_blank')">
                        <p class="text-sm text-gray-500 mt-2">Klik gambar untuk memperbesar</p>
                    @else
                        <p class="text-gray-500">Belum ada bukti transfer</p>
                    @endif
                </div>
            </div>

            <!-- Verifikasi Info -->
            @if($payment->status != 'pending')
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Informasi Verifikasi</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-500">Diverifikasi oleh</p>
                            <p class="font-semibold">{{ $payment->verifier?->nama ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Tanggal Verifikasi</p>
                            <p class="font-semibold">{{ $payment->tanggal_verifikasi?->format('d M Y H:i') ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Tombol Aksi -->
            @if($payment->status == 'pending')
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Verifikasi Pembayaran</h3>
                    <div class="flex space-x-4">
                        <!-- Tombol Terima -->
                        <form action="{{ route('admin.payments.verify', $payment->id) }}" method="POST" class="flex-1" onsubmit="return confirm('Yakin ingin menerima pembayaran ini? Status servis akan diubah menjadi Diambil (Lunas).')">
                            @csrf
                            <button type="submit" class="w-full bg-green-500 hover:bg-green-700 text-white font-bold py-3 px-4 rounded">
                                ✅ Terima Pembayaran
                            </button>
                        </form>

                        <!-- Tombol Tolak -->
                        <button onclick="showRejectModal()" class="flex-1 bg-red-500 hover:bg-red-700 text-white font-bold py-3 px-4 rounded">
                            ❌ Tolak Pembayaran
                        </button>
                    </div>
                </div>
            </div>

            <!-- Modal Tolak (Hidden by default) -->
            <div id="rejectModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
                <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                    <h3 class="text-lg font-semibold mb-4">Alasan Penolakan</h3>
                    <form action="{{ route('admin.payments.reject', $payment->id) }}" method="POST">
                        @csrf
                        <textarea name="keterangan_reject" rows="4" 
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-red-500 focus:ring-red-500" 
                            placeholder="Contoh: Bukti transfer tidak jelas, nominal tidak sesuai, dll." required></textarea>
                        <div class="flex space-x-3 mt-4">
                            <button type="button" onclick="hideRejectModal()" 
                                class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                                Batal
                            </button>
                            <button type="submit" 
                                class="flex-1 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                Tolak
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            @endif

        </div>
    </div>

    <!-- Script Modal -->
    <script>
        function showRejectModal() {
            document.getElementById('rejectModal').classList.remove('hidden');
        }
        function hideRejectModal() {
            document.getElementById('rejectModal').classList.add('hidden');
        }
    </script>
</x-app-layout>