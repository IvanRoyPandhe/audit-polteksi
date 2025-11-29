<x-dashboard-layout>
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900 mb-2">Detail Indikator Kinerja</h1>
                <p class="text-gray-600 text-sm">Informasi lengkap indikator kinerja</p>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('indikator-kinerja.edit', $indikatorKinerja) }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg">
                    Edit
                </a>
                <a href="{{ route('indikator-kinerja.index') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium rounded-lg">
                    Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Info -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Informasi Umum -->
            <div class="bg-white rounded-lg border">
                <div class="px-6 py-4 border-b">
                    <h2 class="text-lg font-semibold text-gray-900">Informasi Umum</h2>
                </div>
                <div class="p-6 space-y-4">
                    <div>
                        <label class="text-sm font-medium text-gray-500">Nama Indikator</label>
                        <p class="mt-1 text-base text-gray-900">{{ $indikatorKinerja->nama_indikator }}</p>
                    </div>
                    
                    <div>
                        <label class="text-sm font-medium text-gray-500">Deskripsi</label>
                        <p class="mt-1 text-base text-gray-900 whitespace-pre-line">{{ $indikatorKinerja->deskripsi ?? 'Tidak ada deskripsi' }}</p>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="text-sm font-medium text-gray-500">Target</label>
                            <p class="mt-1 text-base text-gray-900">{{ number_format($indikatorKinerja->target, 2) }}%</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Status</label>
                            <p class="mt-1">
                                <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full 
                                    {{ $indikatorKinerja->status == 'Aktif' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                    {{ $indikatorKinerja->status }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kriteria -->
            <div class="bg-white rounded-lg border">
                <div class="px-6 py-4 border-b">
                    <h2 class="text-lg font-semibold text-gray-900">Kriteria Terkait</h2>
                </div>
                <div class="p-6">
                    @if($indikatorKinerja->kriteria->count() > 0)
                        <div class="space-y-3">
                            @foreach($indikatorKinerja->kriteria as $kriteria)
                                <div class="p-4 bg-gray-50 rounded-lg">
                                    <h3 class="font-medium text-gray-900">{{ $kriteria->nama_kriteria }}</h3>
                                    <p class="text-sm text-gray-600 mt-1">Bobot: {{ $kriteria->bobot }}%</p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-sm">Belum ada kriteria terkait</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Standar & Unit -->
            <div class="bg-white rounded-lg border">
                <div class="px-6 py-4 border-b">
                    <h2 class="text-lg font-semibold text-gray-900">Standar & Unit</h2>
                </div>
                <div class="p-6 space-y-4">
                    <div>
                        <label class="text-sm font-medium text-gray-500">Standar Mutu</label>
                        <p class="mt-1 text-base text-gray-900">{{ $indikatorKinerja->standar->nama_standar ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Unit</label>
                        <p class="mt-1 text-base text-gray-900">{{ $indikatorKinerja->unit->nama_unit ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>

            <!-- Data Kinerja -->
            <div class="bg-white rounded-lg border">
                <div class="px-6 py-4 border-b">
                    <h2 class="text-lg font-semibold text-gray-900">Data Kinerja</h2>
                </div>
                <div class="p-6">
                    @if($indikatorKinerja->dataKinerja->count() > 0)
                        <div class="space-y-3">
                            @foreach($indikatorKinerja->dataKinerja->take(5) as $data)
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-600">{{ $data->periode }}</span>
                                    <span class="text-sm font-medium text-gray-900">{{ number_format($data->nilai, 2) }}%</span>
                                </div>
                            @endforeach
                        </div>
                        @if($indikatorKinerja->dataKinerja->count() > 5)
                            <p class="text-xs text-gray-500 mt-3">Dan {{ $indikatorKinerja->dataKinerja->count() - 5 }} data lainnya</p>
                        @endif
                    @else
                        <p class="text-gray-500 text-sm">Belum ada data kinerja</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>
