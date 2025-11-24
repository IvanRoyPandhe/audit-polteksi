<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AuditTemuan;

class AuditTemuanSeeder extends Seeder
{
    public function run(): void
    {
        $temuans = [
            ['audit_id' => 1, 'kategori_temuan' => 'Non-Conformity', 'deskripsi_temuan' => 'Dokumentasi tidak lengkap pada proses pembelajaran', 'severity' => 'Sedang', 'rekomendasi' => 'Lengkapi dokumentasi proses pembelajaran'],
            ['audit_id' => 1, 'kategori_temuan' => 'Observation', 'deskripsi_temuan' => 'Perlu peningkatan fasilitas laboratorium', 'severity' => 'Rendah', 'rekomendasi' => 'Tingkatkan fasilitas laboratorium secara bertahap'],
            ['audit_id' => 2, 'kategori_temuan' => 'Non-Conformity', 'deskripsi_temuan' => 'Keterlambatan dalam pelaporan kinerja dosen', 'severity' => 'Tinggi', 'rekomendasi' => 'Perbaiki sistem pelaporan dan monitoring'],
            ['audit_id' => 2, 'kategori_temuan' => 'Opportunity', 'deskripsi_temuan' => 'Potensi peningkatan sistem informasi akademik', 'severity' => 'Rendah', 'rekomendasi' => 'Evaluasi dan upgrade sistem informasi akademik']
        ];

        foreach ($temuans as $temuan) {
            AuditTemuan::create($temuan);
        }
    }
}