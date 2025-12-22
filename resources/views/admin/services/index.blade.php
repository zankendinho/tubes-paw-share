<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <h2 class="font-bold text-2xl text-slate-800 leading-tight">
                {{ __('Kelola Servis') }}
            </h2>
            <a href="{{ route('admin.services.create') }}" 
               class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150 shadow-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Servis
            </a>
        </div>
    </x-slot>

    <div class="py-10 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
            <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-lg flex items-center shadow-sm" role="alert">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm rounded-xl border border-blue-100 mb-6">
                <div class="p-4 border-b border-blue-50 bg-white">
                    <div class="flex flex-wrap gap-2 items-center">
                        <span class="text-sm font-semibold text-slate-500 mr-2">Filter Status:</span>
                        
                        @php
                            $baseClass = "px-4 py-2 rounded-full text-sm font-medium transition-all duration-200 border";
                            $activeClass = "bg-blue-600 text-white border-blue-600 shadow-md";
                            $inactiveClass = "bg-white text-slate-600 border-slate-200 hover:bg-blue-50 hover:text-blue-600 hover:border-blue-200";
                        @endphp

                        <a href="{{ route('admin.services.index') }}" 
                           class="{{ $baseClass }} {{ !request('status') ? $activeClass : $inactiveClass }}">
                            Semua <span class="ml-1 opacity-80 text-xs">({{ \App\Models\Service::count() }})</span>
                        </a>
                        
                        <a href="{{ route('admin.services.index', ['status' => 'pending']) }}" 
                           class="{{ $baseClass }} {{ request('status') == 'pending' ? 'bg-amber-500 text-white border-amber-500 shadow-md' : 'bg-white text-slate-600 border-slate-200 hover:bg-amber-50 hover:text-amber-600 hover:border-amber-200' }}">
                            Pending <span class="ml-1 opacity-80 text-xs">({{ \App\Models\Service::where('status', 'pending')->count() }})</span>
                        </a>

                        <a href="{{ route('admin.services.index', ['status' => 'proses']) }}" 
                           class="{{ $baseClass }} {{ request('status') == 'proses' ? $activeClass : $inactiveClass }}">
                            Proses <span class="ml-1 opacity-80 text-xs">({{ \App\Models\Service::where('status', 'proses')->count() }})</span>
                        </a>

                        <a href="{{ route('admin.services.index', ['status' => 'selesai']) }}" 
                           class="{{ $baseClass }} {{ request('status') == 'selesai' ? 'bg-emerald-600 text-white border-emerald-600 shadow-md' : 'bg-white text-slate-600 border-slate-200 hover:bg-emerald-50 hover:text-emerald-600 hover:border-emerald-200' }}">
                            Selesai <span class="ml-1 opacity-80 text-xs">({{ \App\Models\Service::where('status', 'selesai')->count() }})</span>
                        </a>

                        <a href="{{ route('admin.services.index', ['status' => 'diambil']) }}" 
                           class="{{ $baseClass }} {{ request('status') == 'diambil' ? 'bg-indigo-600 text-white border-indigo-600 shadow-md' : 'bg-white text-slate-600 border-slate-200 hover:bg-indigo-50 hover:text-indigo-600 hover:border-indigo-200' }}">
                            Diambil <span class="ml-1 opacity-80 text-xs">({{ \App\Models\Service::where('status', 'diambil')->count() }})</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm rounded-xl border border-blue-100">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-blue-50">
                        <thead class="bg-blue-50/50">
                            <tr>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-blue-800 uppercase tracking-wider">Kode</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-blue-800 uppercase tracking-wider">Customer</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-blue-800 uppercase tracking-wider">Device</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-blue-800 uppercase tracking-wider">Keluhan</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-blue-800 uppercase tracking-wider">Teknisi</th>
                                <th scope="col" class="px-6 py-4 text-center text-xs font-semibold text-blue-800 uppercase tracking-wider">Status & Prioritas</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-blue-800 uppercase tracking-wider">Tanggal</th>
                                <th scope="col" class="px-6 py-4 text-center text-xs font-semibold text-blue-800 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-100">
                            @forelse($services as $service)
                            <tr class="hover:bg-blue-50/30 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-blue-600">
                                    <a href="{{ route('admin.services.show', $service->id) }}" class="hover:underline">
                                        {{ $service->kode_servis }}
                                    </a>
                                </td>
                                
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-slate-900">{{ $service->customer->nama }}</div>
                                    <div class="text-xs text-slate-500 flex items-center">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                        {{ $service->customer->telp ?? '-' }}
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-slate-900">{{ $service->device->merk }}</div>
                                    <div class="text-xs text-slate-500 bg-slate-100 px-2 py-0.5 rounded inline-block mt-1">
                                        {{ $service->device->kategori }}
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    <p class="text-sm text-slate-600 max-w-xs truncate" title="{{ $service->keluhan }}">
                                        {{ Str::limit($service->keluhan, 30) }}
                                    </p>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">
                                    @if($service->technician)
                                        <div class="flex items-center">
                                            <div class="h-6 w-6 rounded-full bg-blue-100 flex items-center justify-center text-xs text-blue-600 font-bold mr-2">
                                                {{ substr($service->technician->user->nama, 0, 1) }}
                                            </div>
                                            {{ $service->technician->user->nama }}
                                        </div>
                                    @else
                                        <span class="text-slate-400 italic">Belum ditentukan</span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex flex-col gap-1 items-center">
                                        @php
                                            $statusClass = match($service->status) {
                                                'pending' => 'bg-amber-100 text-amber-700 border-amber-200',
                                                'proses' => 'bg-blue-100 text-blue-700 border-blue-200',
                                                'selesai' => 'bg-emerald-100 text-emerald-700 border-emerald-200',
                                                'diambil' => 'bg-indigo-100 text-indigo-700 border-indigo-200',
                                                'batal' => 'bg-rose-100 text-rose-700 border-rose-200',
                                                default => 'bg-gray-100 text-gray-700 border-gray-200'
                                            };
                                        @endphp
                                        <span class="px-2.5 py-0.5 text-xs font-semibold rounded-full border {{ $statusClass }}">
                                            {{ ucfirst($service->status) }}
                                        </span>

                                        @if($service->prioritas == 'urgent')
                                            <span class="px-2 py-0.5 text-[10px] font-bold tracking-wider uppercase text-rose-600 bg-rose-50 border border-rose-100 rounded-md">
                                                Urgent
                                            </span>
                                        @endif
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">
                                    {{ $service->tanggal_masuk->format('d M Y') }}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                    <div class="flex justify-center space-x-2">
                                        <a href="{{ route('admin.services.show', $service->id) }}" class="p-1.5 bg-blue-50 text-blue-600 rounded-md hover:bg-blue-100 transition duration-150" title="Detail">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        </a>
                                        
                                        <a href="{{ route('admin.services.edit', $service->id) }}" class="p-1.5 bg-amber-50 text-amber-600 rounded-md hover:bg-amber-100 transition duration-150" title="Edit">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        </a>

                                        <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus data servis {{ $service->kode_servis }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-1.5 bg-rose-50 text-rose-600 rounded-md hover:bg-rose-100 transition duration-150" title="Hapus">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="px-6 py-12 text-center text-slate-500">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="bg-slate-100 p-4 rounded-full mb-3">
                                            <svg class="h-10 w-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                            </svg>
                                        </div>
                                        <p class="text-lg font-medium text-slate-900">Belum ada data servis</p>
                                        <p class="text-sm text-slate-500">Silakan tambahkan data servis baru atau ubah filter pencarian.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($services->hasPages())
                <div class="px-6 py-4 border-t border-blue-50 bg-slate-50">
                    {{ $services->links() }}
                </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>