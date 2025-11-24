<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TindakLanjut;

class TindakLanjutSeeder extends Seeder
{
    public function run(): void
    {
        $tindakLanjuts = [
            ['temuan_id' => 1, 'rencana_perbaikan' => 'Melengkapi dokumentasi proses pembelajaran sesuai standar', 'tanggal_target' => '2024-03-15', 'status_tindak' => 'Berlangsung', 'penanggung_jawab' => 2],
            ['temuan_id' => 2, 'rencana_perbaikan' => 'Pengadaan peralatan laboratorium baru', 'tanggal_target' => '2024-06-30', 'status_tindak' => 'Direncanakan', 'penanggung_jawab' => 1],
            ['temuan_id' => 3, 'rencana_perbaikan' => 'Implementasi sistem reminder otomatis untuk pelaporan', 'tanggal_target' => '2024-02-28', 'status_tindak' => 'Selesai', 'penanggung_jawab' => 3, 'tanggal_selesai' => '2024-02-25'],
            ['temuan_id' => 4, 'rencana_perbaikan' => 'Upgrade sistem informasi akademik', 'tanggal_target' => '2024-12-31', 'status_tindak' => 'Direncanakan', 'penanggung_jawab' => 1]
        ];

        foreach ($tindakLanjuts as $tindak) {
            TindakLanjut::create($tindak);
        }
    }
}