<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $table = 'laporan';
    protected $primaryKey = 'laporan_id';
    public $timestamps = false;

    protected $fillable = [
        'audit_id',
        'periode',
        'hasil_ringkas',
        'total_kinerja',
        'rekomendasi_umum',
        'file_laporan',
        'dibuat_oleh',
        'tanggal_laporan'
    ];

    protected $casts = [
        'tanggal_laporan' => 'date'
    ];

    public function audit()
    {
        return $this->belongsTo(Audit::class, 'audit_id', 'audit_id');
    }

    public function pembuatLaporan()
    {
        return $this->belongsTo(User::class, 'dibuat_oleh', 'user_id');
    }

    // Alias untuk pembuatLaporan
    public function pembuat()
    {
        return $this->belongsTo(User::class, 'dibuat_oleh', 'user_id');
    }
}