<x-dashboard-layout>
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Edit Validasi</h1>
        <p class="text-gray-600 mt-1">Ubah data validasi</p>
    </div>

    <div class="bg-white rounded-lg shadow">
        <div class="p-6">
            <form method="POST" action="{{ route('validasi.update', $validasi->validasi_id) }}">
                @csrf
                @method('PUT')
                
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Data Kinerja</label>
                    <select name="kinerja_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                        <option value="">Pilih Data Kinerja</option>
                        @foreach($dataKinerjas as $kinerja)
                            <option value="{{ $kinerja->kinerja_id }}" {{ old('kinerja_id', $validasi->kinerja_id) == $kinerja->kinerja_id ? 'selected' : '' }}>
                                {{ $kinerja->periode }} - {{ $kinerja->indikator->nama_indikator ?? 'N/A' }}
                            </option>
                        @endforeach
                    </select>
                    @error('kinerja_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Validasi</label>
                    <input type="date" name="tanggal_validasi" value="{{ old('tanggal_validasi', $validasi->tanggal_validasi?->format('Y-m-d')) }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                    @error('tanggal_validasi')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status Validasi</label>
                    <select name="status_validasi" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                        <option value="">Pilih Status</option>
                        <option value="Disetujui" {{ old('status_validasi', $validasi->status_validasi) == 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
                        <option value="Ditolak" {{ old('status_validasi', $validasi->status_validasi) == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                        <option value="Revisi" {{ old('status_validasi', $validasi->status_validasi) == 'Revisi' ? 'selected' : '' }}>Revisi</option>
                    </select>
                    @error('status_validasi')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Catatan</label>
                    <textarea name="catatan" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('catatan', $validasi->catatan) }}</textarea>
                    @error('catatan')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-end space-x-3 pt-6 border-t border-gray-200">
                    <a href="{{ route('validasi.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
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
