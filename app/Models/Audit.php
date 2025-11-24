<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\LogsActivity;

class Audit extends Model
{
    use LogsActivity;
    
    protected $table = 'audit';
    protected $primaryKey = 'audit_id';
    public $timestamps = false;

    protected $fillable = [
        'validasi_id',
        'auditor_id',
        'tanggal_audit',
        'status_audit',
        'skor_total',
        'periode'
    ];

    protected $casts = [
        'tanggal_audit' => 'date'
    ];

    public function validasi()
    {
        return $this->belongsTo(Validasi::class, 'validasi_id', 'validasi_id');
    }

    public function auditor()
    {
        return $this->belongsTo(User::class, 'auditor_id', 'user_id');
    }

    public function auditTemuan()
    {
        return $this->hasMany(AuditTemuan::class, 'audit_id', 'audit_id');
    }

    public function laporan()
    {
        return $this->hasMany(Laporan::class, 'audit_id', 'audit_id');
    }
}