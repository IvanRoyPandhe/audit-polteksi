<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TindakLanjut extends Model
{
    protected $table = 'tindak_lanjut';
    protected $primaryKey = 'tindak_id';
    public $timestamps = false;

    protected $fillable = [
        'temuan_id',
        'penanggung_jawab',
        'rencana_perbaikan',
        'tanggal_target',
        'status_tindak',
        'tanggal_selesai'
    ];

    protected $casts = [
        'tanggal_target' => 'date',
        'tanggal_selesai' => 'date'
    ];

    public function auditTemuan()
    {
        return $this->belongsTo(AuditTemuan::class, 'temuan_id', 'temuan_id');
    }

    // Alias untuk auditTemuan
    public function temuan()
    {
        return $this->belongsTo(AuditTemuan::class, 'temuan_id', 'temuan_id');
    }

    public function penanggungJawab()
    {
        return $this->belongsTo(User::class, 'penanggung_jawab', 'user_id');
    }
}