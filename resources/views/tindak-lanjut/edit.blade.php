<x-dashboard-layout>
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Edit Tindak Lanjut</h1>
        <p class="text-gray-600 mt-1">Ubah rencana tindak lanjut</p>
    </div>

    <div class="bg-white rounded-lg shadow">
        <div class="p-6">
            <form method="POST" action="{{ route('tindak-lanjut.update', $tindakLanjut->tindak_id) }}">
                @csrf
                @method('PUT')
                
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Temuan Audit</label>
                    <select name="temuan_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                        <option value="">Pilih Temuan</option>
                        @foreach($temuans as $temuan)
                            <option value="{{ $temuan->temuan_id }}" {{ old('temuan_id', $tindakLanjut->temuan_id) == $temuan->temuan_id ? 'selected' : '' }}>
                                {{ $temuan->kategori_temuan }} - {{ Str::limit($temuan->deskripsi_temuan, 50) }}
                            </option>
                        @endforeach
                    </select>
                    @error('temuan_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Rencana Perbaikan</label>
                    <textarea name="rencana_perbaikan" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>{{ old('rencana_perbaikan', $tindakLanjut->rencana_perbaikan) }}</textarea>
                    @error('rencana_perbaikan')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Target</label>
                    <input type="date" name="tanggal_target" value="{{ old('tanggal_target', $tindakLanjut->tanggal_target?->format('Y-m-d')) }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                    @error('tanggal_target')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status Tindak Lanjut</label>
                    <select name="status_tindak" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                        <option value="">Pilih Status</option>
                        <option value="Direncanakan" {{ old('status_tindak', $tindakLanjut->status_tindak) == 'Direncanakan' ? 'selected' : '' }}>Direncanakan</option>
                        <option value="Berlangsung" {{ old('status_tindak', $tindakLanjut->status_tindak) == 'Berlangsung' ? 'selected' : '' }}>Berlangsung</option>
                        <option value="Selesai" {{ old('status_tindak', $tindakLanjut->status_tindak) == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                    @error('status_tindak')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Selesai (Optional)</label>
                    <input type="date" name="tanggal_selesai" value="{{ old('tanggal_selesai', $tindakLanjut->tanggal_selesai?->format('Y-m-d')) }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    @error('tanggal_selesai')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-end space-x-3 pt-6 border-t border-gray-200">
                    <a href="{{ route('tindak-lanjut.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
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
