<x-dashboard-layout>
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-gray-900 mb-2">Validasi</h1>
        <p class="text-gray-600 text-sm">Kelola validasi data kinerja</p>
    </div>

    @if(session('success'))
        <div class="bg-green-50 text-green-700 px-3 py-2 rounded mb-4 text-sm">{{ session('success') }}</div>
    @endif

    <div class="flex justify-between items-center mb-6">
        <div class="relative">
            <input type="text" placeholder="Cari validasi..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg text-sm w-64 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <a href="{{ route('validasi.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium">+ Tambah Validasi</a>
    </div>

    <div class="bg-white rounded-lg border">
        <table class="w-full">
            <thead>
                <tr class="border-b bg-gray-50">
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Data Kinerja</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Capaian</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Dokumen</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Validator</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-4 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($validasis as $validasi)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 text-sm font-medium text-gray-900">
                        <div>{{ $validasi->kinerja->indikator->nama_indikator ?? 'N/A' }}</div>
                        <div class="text-xs text-gray-500">Periode: {{ $validasi->kinerja->periode ?? '-' }}</div>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ number_format($validasi->kinerja->capaian ?? 0, 2) }}%</td>
                    <td class="px-6 py-4 text-sm text-gray-900">
                        @if($validasi->kinerja->bukti_file)
                            <a href="{{ $validasi->kinerja->bukti_file }}" target="_blank" class="inline-flex items-center text-blue-600 hover:text-blue-800">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                </svg>
                                Lihat
                            </a>
                        @else
                            <span class="text-gray-400 text-xs">Tidak ada</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-900">
                        <div class="font-medium">{{ $validasi->validator->name ?? 'N/A' }}</div>
                        @if($validasi->validator->unit ?? false)
                            <div class="text-xs text-gray-500">{{ $validasi->validator->unit->nama_unit }}</div>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-900">
                        <div class="font-medium">{{ \Carbon\Carbon::parse($validasi->tanggal_validasi)->format('d M Y') }}</div>
                        <div class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($validasi->tanggal_validasi)->diffForHumans() }}</div>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-900">
                        <span class="inline-flex items-center px-2.5 py-1 text-xs font-semibold rounded-full 
                            @if($validasi->status_validasi == 'Disetujui') bg-green-100 text-green-800
                            @elseif($validasi->status_validasi == 'Ditolak') bg-red-100 text-red-800
                            @else bg-yellow-100 text-yellow-800 @endif">
                            @if($validasi->status_validasi == 'Disetujui')
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                            @elseif($validasi->status_validasi == 'Ditolak')
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                            @else
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                </svg>
                            @endif
                            {{ $validasi->status_validasi }}
                        </span>
                        @if($validasi->catatan)
                            <div class="text-xs text-gray-500 mt-1 italic">{{ Str::limit($validasi->catatan, 30) }}</div>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right text-sm font-medium">
                        <div class="flex justify-end items-center space-x-2">
                            <a href="{{ route('validasi.edit', $validasi) }}" class="text-gray-400 hover:text-gray-600">
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