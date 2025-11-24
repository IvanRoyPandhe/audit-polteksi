<x-dashboard-layout>
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Edit Audit</h1>
        <p class="text-gray-600 mt-1">Ubah data audit</p>
    </div>

    <div class="bg-white rounded-lg shadow">
        <div class="p-6">
            <form method="POST" action="{{ route('audit.update', $audit->audit_id) }}">
                @csrf
                @method('PUT')
                
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Validasi</label>
                    <select name="validasi_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                        <option value="">Pilih Validasi</option>
                        @foreach($validasis as $validasi)
                            <option value="{{ $validasi->validasi_id }}" {{ old('validasi_id', $audit->validasi_id) == $validasi->validasi_id ? 'selected' : '' }}>
                                Validasi #{{ $validasi->validasi_id }} - {{ $validasi->status_validasi }}
                            </option>
                        @endforeach
                    </select>
                    @error('validasi_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Audit</label>
                    <input type="date" name="tanggal_audit" value="{{ old('tanggal_audit', $audit->tanggal_audit?->format('Y-m-d')) }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                    @error('tanggal_audit')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status Audit</label>
                    <select name="status_audit" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                        <option value="">Pilih Status</option>
                        <option value="Direncanakan" {{ old('status_audit', $audit->status_audit) == 'Direncanakan' ? 'selected' : '' }}>Direncanakan</option>
                        <option value="Berlangsung" {{ old('status_audit', $audit->status_audit) == 'Berlangsung' ? 'selected' : '' }}>Berlangsung</option>
                        <option value="Selesai" {{ old('status_audit', $audit->status_audit) == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                    @error('status_audit')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Periode</label>
                    <input type="text" name="periode" value="{{ old('periode', $audit->periode) }}" placeholder="Contoh: 2024-1" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                    @error('periode')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Skor Total (Optional)</label>
                    <input type="number" step="0.01" name="skor_total" value="{{ old('skor_total', $audit->skor_total) }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    @error('skor_total')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-end space-x-3 pt-6 border-t border-gray-200">
                    <a href="{{ route('audit.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
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
