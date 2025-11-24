<x-dashboard-layout>
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-gray-900 mb-2">Data Kinerja</h1>
        <p class="text-gray-600 text-sm">Kelola data kinerja organisasi</p>
    </div>

    @if(session('success'))
        <div class="bg-green-50 text-green-700 px-3 py-2 rounded mb-4 text-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-6">
        <form method="GET" action="{{ route('data-kinerja.index') }}" class="flex gap-3 items-end">
            <div class="flex-1">
                <label class="block text-sm font-medium text-gray-700 mb-1">Cari</label>
                <div class="relative">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari periode atau indikator..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg text-sm w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <svg class="w-4 h-4 text-gray-400 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>
            <div class="w-48">
                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua Status</option>
                    <option value="Draft" {{ request('status') == 'Draft' ? 'selected' : '' }}>Draft</option>
                    <option value="Submitted" {{ request('status') == 'Submitted' ? 'selected' : '' }}>Submitted</option>
                    <option value="Validated" {{ request('status') == 'Validated' ? 'selected' : '' }}>Validated</option>
                </select>
            </div>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium">
                Filter
            </button>
            @if(request()->hasAny(['search', 'status', 'periode']))
                <a href="{{ route('data-kinerja.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium">
                    Reset
                </a>
            @endif
            <a href="{{ route('data-kinerja.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium">
                + Tambah
            </a>
        </form>
    </div>

    <div class="bg-white rounded-lg border">
        <table class="w-full">
            <thead>
                <tr class="border-b bg-gray-50">
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Indikator & Unit</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Periode</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Capaian vs Target</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Dokumen</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-4 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($dataKinerja as $data)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 text-sm font-medium text-gray-900">
                        <div class="font-semibold">{{ $data->indikator->nama_indikator ?? 'N/A' }}</div>
                        <div class="text-xs text-gray-500 mt-1">
                            <span class="inline-flex items-center">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                                </svg>
                                {{ $data->user->name ?? 'N/A' }}
                            </span>
                            @if($data->user->unit ?? false)
                                <span class="ml-2 text-gray-400">• {{ $data->user->unit->nama_unit }}</span>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-900">
                        <div class="font-medium">{{ $data->periode }}</div>
                        @if($data->created_at)
                            <div class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($data->created_at)->format('d M Y') }}</div>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-900">
                        <div class="flex items-center">
                            <div class="flex-1">
                                <div class="flex items-baseline">
                                    <span class="text-lg font-bold {{ $data->capaian >= ($data->indikator->target ?? 100) ? 'text-green-600' : 'text-orange-600' }}">
                                        {{ number_format($data->capaian, 1) }}%
                                    </span>
                                    @if($data->indikator->target ?? false)
                                        <span class="text-xs text-gray-500 ml-2">/ {{ number_format($data->indikator->target, 0) }}%</span>
                                    @endif
                                </div>
                                @if($data->indikator->target ?? false)
                                    @php
                                        $gap = $data->capaian - $data->indikator->target;
                                    @endphp
                                    <div class="text-xs {{ $gap >= 0 ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $gap >= 0 ? '+' : '' }}{{ number_format($gap, 1) }}% dari target
                                    </div>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-900">
                        @if($data->bukti_file)
                            <a href="{{ $data->bukti_file }}" target="_blank" class="inline-flex items-center text-blue-600 hover:text-blue-800">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                </svg>
                                Lihat Dokumen
                            </a>
                        @else
                            <span class="text-gray-400 text-xs">Tidak ada</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-900">
                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                            @if($data->status == 'Validated') bg-green-100 text-green-800
                            @elseif($data->status == 'Submitted') bg-blue-100 text-blue-800
                            @else bg-yellow-100 text-yellow-800 @endif">
                            {{ $data->status }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right text-sm font-medium">
                        <div class="flex justify-end items-center space-x-1">
                            <a href="{{ route('data-kinerja.edit', $data) }}" 
                               class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors"
                               title="Edit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </a>
                            <form method="POST" action="{{ route('data-kinerja.destroy', $data) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" 
                                        onclick="return confirm('Yakin hapus data ini? Data akan dipindahkan ke trash.')"
                                        title="Hapus">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    @if($dataKinerja->hasPages())
    <div class="mt-6 flex items-center justify-between">
        <div class="text-sm text-gray-700">
            Menampilkan {{ $dataKinerja->firstItem() }} - {{ $dataKinerja->lastItem() }} dari {{ $dataKinerja->total() }} data
        </div>
        <div>
            {{ $dataKinerja->appends(request()->query())->links() }}
        </div>
    </div>
    @endif
</x-dashboard-layout>