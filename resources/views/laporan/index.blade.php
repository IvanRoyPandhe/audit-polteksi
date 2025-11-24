<x-dashboard-layout>
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-gray-900 mb-2">Laporan</h1>
        <p class="text-gray-600 text-sm">Kelola laporan audit</p>
    </div>

    @if(session('success'))
        <div class="bg-green-50 text-green-700 px-3 py-2 rounded mb-4 text-sm">{{ session('success') }}</div>
    @endif

    <div class="flex justify-between items-center mb-6">
        <div class="relative">
            <input type="text" placeholder="Cari laporan..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg text-sm w-64 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <a href="{{ route('laporan.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium">+ Tambah Laporan</a>
    </div>

    <div class="bg-white rounded-lg border">
        <table class="w-full">
            <thead>
                <tr class="border-b bg-gray-50">
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Periode</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Audit</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Hasil Ringkas</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Pembuat</th>
                    <th class="px-6 py-4 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($laporans as $laporan)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $laporan->periode }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">
                        <div>Skor: {{ $laporan->audit->skor_total ?? 'N/A' }}</div>
                        @if($laporan->audit->validasi->kinerja->bukti_file ?? false)
                            <a href="{{ $laporan->audit->validasi->kinerja->bukti_file }}" target="_blank" class="text-xs text-blue-600 hover:text-blue-800 inline-flex items-center">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                </svg>
                                Dokumen
                            </a>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $laporan->tanggal_laporan }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ Str::limit($laporan->hasil_ringkas, 50) }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $laporan->pembuat->name ?? 'N/A' }}</td>
                    <td class="px-6 py-4 text-right text-sm font-medium">
                        <div class="flex justify-end items-center space-x-2">
                            <a href="{{ route('laporan.edit', $laporan) }}" class="text-gray-400 hover:text-gray-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-dashboard-layout>