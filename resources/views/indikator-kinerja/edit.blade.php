<x-dashboard-layout>
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Edit Indikator Kinerja</h1>
        <p class="text-gray-600 mt-1">Ubah data indikator kinerja</p>
    </div>

    <div class="bg-white rounded-lg shadow">
        <div class="p-6">
            <form method="POST" action="{{ route('indikator-kinerja.update', $indikatorKinerja->indikator_id) }}">
                @csrf
                @method('PUT')
                
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Standar Mutu</label>
                    <select name="standar_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                        <option value="">Pilih Standar Mutu</option>
                        @foreach($standars as $standar)
                            <option value="{{ $standar->standar_id }}" {{ old('standar_id', $indikatorKinerja->standar_id) == $standar->standar_id ? 'selected' : '' }}>
                                {{ $standar->nama_standar }}
                            </option>
                        @endforeach
                    </select>
                    @error('standar_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Indikator</label>
                    <input type="text" name="nama_indikator" value="{{ old('nama_indikator', $indikatorKinerja->nama_indikator) }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                    @error('nama_indikator')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                    <textarea name="deskripsi" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('deskripsi', $indikatorKinerja->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Target</label>
                    <input type="number" step="0.01" name="target" value="{{ old('target', $indikatorKinerja->target) }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                    @error('target')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                        <option value="">Pilih Status</option>
                        <option value="Aktif" {{ old('status', $indikatorKinerja->status) == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="Tidak Aktif" {{ old('status', $indikatorKinerja->status) == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-end space-x-3 pt-6 border-t border-gray-200">
                    <a href="{{ route('indikator-kinerja.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
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
