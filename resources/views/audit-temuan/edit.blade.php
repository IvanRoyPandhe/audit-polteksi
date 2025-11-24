<x-dashboard-layout>
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Edit Temuan Audit</h1>
        <p class="text-gray-600 mt-1">Ubah data temuan audit</p>
    </div>

    <div class="bg-white rounded-lg shadow">
        <div class="p-6">
            <form method="POST" action="{{ route('audit-temuan.update', $auditTemuan->temuan_id) }}">
                @csrf
                @method('PUT')
                
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Audit</label>
                    <select name="audit_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                        <option value="">Pilih Audit</option>
                        @foreach($audits as $audit)
                            <option value="{{ $audit->audit_id }}" {{ old('audit_id', $auditTemuan->audit_id) == $audit->audit_id ? 'selected' : '' }}>
                                Audit #{{ $audit->audit_id }} - {{ $audit->periode }} ({{ $audit->status_audit }})
                            </option>
                        @endforeach
                    </select>
                    @error('audit_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kategori Temuan</label>
                    <select name="kategori_temuan" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                        <option value="">Pilih Kategori</option>
                        <option value="Non-Conformity" {{ old('kategori_temuan', $auditTemuan->kategori_temuan) == 'Non-Conformity' ? 'selected' : '' }}>Non-Conformity</option>
                        <option value="Observation" {{ old('kategori_temuan', $auditTemuan->kategori_temuan) == 'Observation' ? 'selected' : '' }}>Observation</option>
                        <option value="Opportunity" {{ old('kategori_temuan', $auditTemuan->kategori_temuan) == 'Opportunity' ? 'selected' : '' }}>Opportunity</option>
                    </select>
                    @error('kategori_temuan')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Temuan</label>
                    <textarea name="deskripsi_temuan" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>{{ old('deskripsi_temuan', $auditTemuan->deskripsi_temuan) }}</textarea>
                    @error('deskripsi_temuan')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Severity</label>
                    <select name="severity" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                        <option value="">Pilih Severity</option>
                        <option value="Rendah" {{ old('severity', $auditTemuan->severity) == 'Rendah' ? 'selected' : '' }}>Rendah</option>
                        <option value="Sedang" {{ old('severity', $auditTemuan->severity) == 'Sedang' ? 'selected' : '' }}>Sedang</option>
                        <option value="Tinggi" {{ old('severity', $auditTemuan->severity) == 'Tinggi' ? 'selected' : '' }}>Tinggi</option>
                        <option value="Kritis" {{ old('severity', $auditTemuan->severity) == 'Kritis' ? 'selected' : '' }}>Kritis</option>
                    </select>
                    @error('severity')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Rekomendasi</label>
                    <textarea name="rekomendasi" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('rekomendasi', $auditTemuan->rekomendasi) }}</textarea>
                    @error('rekomendasi')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-end space-x-3 pt-6 border-t border-gray-200">
                    <a href="{{ route('audit-temuan.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
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