<x-dashboard-layout>
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Edit Data Kinerja</h1>
        <p class="text-gray-600 mt-1">Ubah data kinerja</p>
    </div>

    <div class="bg-white rounded-lg shadow">
        <div class="p-6">
            <form method="POST" action="{{ route('data-kinerja.update', $dataKinerja->kinerja_id) }}">
                @csrf
                @method('PUT')
                
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Indikator Kinerja</label>
                    <select name="indikator_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                        <option value="">Pilih Indikator</option>
                        @foreach($indikators as $indikator)
                            <option value="{{ $indikator->indikator_id }}" {{ old('indikator_id', $dataKinerja->indikator_id) == $indikator->indikator_id ? 'selected' : '' }}>
                                {{ $indikator->nama_indikator }}
                            </option>
                        @endforeach
                    </select>
                    @error('indikator_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kriteria</label>
                    <select name="kriteria_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                        <option value="">Pilih Kriteria</option>
                        @foreach($kriterias as $kriteria)
                            <option value="{{ $kriteria->kriteria_id }}" {{ old('kriteria_id', $dataKinerja->kriteria_id) == $kriteria->kriteria_id ? 'selected' : '' }}>
                                {{ $kriteria->nama_kriteria }}
                            </option>
                        @endforeach
                    </select>
                    @error('kriteria_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Periode</label>
                    <input type="text" name="periode" value="{{ old('periode', $dataKinerja->periode) }}" placeholder="Contoh: 2024-1" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                    @error('periode')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Capaian</label>
                    <input type="number" step="0.01" name="capaian" value="{{ old('capaian', $dataKinerja->capaian) }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                    @error('capaian')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Link Dokumen Bukti (Google Drive/URL)</label>
                    <input type="url" name="bukti_file" value="{{ old('bukti_file', $dataKinerja->bukti_file) }}" placeholder="https://drive.google.com/..." class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <p class="text-sm text-gray-500 mt-1">Masukkan link Google Drive, Dropbox, atau URL dokumen pendukung</p>
                    @error('bukti_file')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                        <option value="">Pilih Status</option>
                        <option value="Draft" {{ old('status', $dataKinerja->status) == 'Draft' ? 'selected' : '' }}>Draft</option>
                        <option value="Submitted" {{ old('status', $dataKinerja->status) == 'Submitted' ? 'selected' : '' }}>Submitted</option>
                        <option value="Validated" {{ old('status', $dataKinerja->status) == 'Validated' ? 'selected' : '' }}>Validated</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-end space-x-3 pt-6 border-t border-gray-200">
                    <a href="{{ route('data-kinerja.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
                        Batal
                    </a>
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-dashboard-layout>
