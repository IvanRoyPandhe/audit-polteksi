<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AuditTrail;

class AuditTrailSeeder extends Seeder
{
    public function run(): void
    {
        $trails = [
            ['user_id' => 1, 'aksi' => 'CREATE', 'entitas' => 'standar_mutu', 'entitas_id' => 1, 'waktu' => now()->subDays(5), 'detail_perubahan' => json_encode(['action' => 'Membuat standar mutu baru: Standar Akademik'])],
            ['user_id' => 2, 'aksi' => 'UPDATE', 'entitas' => 'data_kinerja', 'entitas_id' => 1, 'waktu' => now()->subDays(3), 'detail_perubahan' => json_encode(['action' => 'Mengupdate data kinerja periode 2024-1'])],
            ['user_id' => 1, 'aksi' => 'CREATE', 'entitas' => 'audit', 'entitas_id' => 1, 'waktu' => now()->subDays(2), 'detail_perubahan' => json_encode(['action' => 'Membuat audit baru untuk periode 2024-1'])],
            ['user_id' => 3, 'aksi' => 'CREATE', 'entitas' => 'validasi', 'entitas_id' => 1, 'waktu' => now()->subDays(1), 'detail_perubahan' => json_encode(['action' => 'Melakukan validasi data kinerja'])],
            ['user_id' => 2, 'aksi' => 'UPDATE', 'entitas' => 'tindak_lanjut', 'entitas_id' => 3, 'waktu' => now(), 'detail_perubahan' => json_encode(['action' => 'Mengupdate status tindak lanjut menjadi Selesai'])]
        ];

        foreach ($trails as $trail) {
            AuditTrail::create($trail);
        }
    }
}