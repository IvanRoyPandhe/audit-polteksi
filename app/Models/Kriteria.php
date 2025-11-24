<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    protected $table = 'kriteria';
    protected $primaryKey = 'kriteria_id';
    public $timestamps = false;

    protected $fillable = [
        'unit_id',
        'indikator_id',
        'nama_kriteria',
        'deskripsi',
        'bobot',
        'nilai_target',
        'nilai_capaian',
        'status'
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id', 'unit_id');
    }

    public function indikatorKinerja()
    {
        return $this->belongsTo(IndikatorKinerja::class, 'indikator_id', 'indikator_id');
    }

    public function scopeForUnit($query, $unitId)
    {
        return $query->where('unit_id', $unitId);
    }

    public function dataKinerja()
    {
        return $this->hasMany(DataKinerja::class, 'kriteria_id', 'kriteria_id');
    }
}