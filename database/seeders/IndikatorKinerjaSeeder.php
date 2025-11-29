<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\IndikatorKinerja;

class IndikatorKinerjaSeeder extends Seeder
{
    public function run(): void
    {
        $indikators = [
            [
                'standar_id' => 1,
                'nama_indikator' => 'Tingkat Kelulusan Mahasiswa',
                'deskripsi' => 'Mengukur persentase mahasiswa yang berhasil menyelesaikan studi tepat waktu dengan IPK minimal 2.75. Indikator ini mencerminkan efektivitas proses pembelajaran dan bimbingan akademik.',
                'target' => 85.00,
                'status' => 'Aktif'
            ],
            [
                'standar_id' => 1,
                'nama_indikator' => 'Kepuasan Mahasiswa terhadap Pembelajaran',
                'deskripsi' => 'Mengukur tingkat kepuasan mahasiswa terhadap kualitas pembelajaran, fasilitas, dan layanan akademik melalui survei berkala. Target minimal 80% mahasiswa menyatakan puas.',
                'target' => 80.00,
                'status' => 'Aktif'
            ],
            [
                'standar_id' => 2,
                'nama_indikator' => 'Jumlah Publikasi Ilmiah',
                'deskripsi' => 'Menghitung jumlah publikasi ilmiah dosen di jurnal nasional dan internasional bereputasi. Publikasi minimal 50 artikel per tahun untuk meningkatkan reputasi institusi.',
                'target' => 50.00,
                'status' => 'Aktif'
            ],
            [
                'standar_id' => 3,
                'nama_indikator' => 'Jumlah Kegiatan Pengabdian',
                'deskripsi' => 'Mengukur jumlah kegiatan pengabdian kepada masyarakat yang dilakukan oleh dosen dan mahasiswa. Target minimal 20 kegiatan per tahun untuk meningkatkan kontribusi sosial.',
                'target' => 20.00,
                'status' => 'Aktif'
            ],
            [
                'standar_id' => 4,
                'nama_indikator' => 'Waktu Pelayanan Administrasi',
                'deskripsi' => 'Mengukur rata-rata waktu penyelesaian layanan administrasi akademik seperti pembuatan surat keterangan, transkrip, dan legalisir. Target maksimal 3 hari kerja.',
                'target' => 3.00,
                'status' => 'Aktif'
            ]
        ];

        foreach ($indikators as $indikator) {
            IndikatorKinerja::create($indikator);
        }
    }
}