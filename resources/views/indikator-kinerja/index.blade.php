<x-dashboard-layout>
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-gray-900 mb-2">Indikator Kinerja</h1>
        <p class="text-gray-600 text-sm">Kelola indikator kinerja berdasarkan standar mutu</p>
    </div>

    @if(session('success'))
        <div class="bg-green-50 text-green-700 px-3 py-2 rounded mb-4 text-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex justify-between items-center mb-6">
        <div class="relative">
            <input type="text" placeholder="Cari indikator..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg text-sm w-64 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <a href="{{ route('indikator-kinerja.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium">
            + Tambah Indikator
        </a>
    </div>

    <div class="bg-white rounded-lg border">
        <table class="w-full">
            <thead>
                <tr class="border-b bg-gray-50">
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Nama Indikator</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Standar Mutu</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Target</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-4 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($indikators as $indikator)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $indikator->nama_indikator }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $indikator->standar->nama_standar ?? 'N/A' }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ number_format($indikator->target, 2) }}%</td>
                    <td class="px-6 py-4 text-sm text-gray-900">
                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                            {{ $indikator->status }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right text-sm font-medium">
                        <div class="flex justify-end items-center space-x-2">
                            <a href="{{ route('indikator-kinerja.show', $indikator) }}" class="text-gray-400 hover:text-blue-600" title="Lihat Detail">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </a>
                            <a href="{{ route('indikator-kinerja.edit', $indikator) }}" class="text-gray-400 hover:text-gray-600" title="Edit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </a>
                            <form method="POST" action="{{ route('indikator-kinerja.destroy', $indikator) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-gray-400 hover:text-red-600" onclick="return confirm('Yakin hapus indikator ini?')" title="Hapus">
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
</x-dashboard-layout>