<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IndikatorKinerja extends Model
{
    protected $table = 'indikator_kinerja';
    protected $primaryKey = 'indikator_id';
    public $timestamps = false;

    protected $fillable = [
        'unit_id',
        'standar_id',
        'nama_indikator',
        'target',
        'status'
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id', 'unit_id');
    }

    public function standarMutu()
    {
        return $this->belongsTo(StandarMutu::class, 'standar_id', 'standar_id');
    }

    public function standar()
    {
        return $this->belongsTo(StandarMutu::class, 'standar_id', 'standar_id');
    }

    public function scopeForUnit($query, $unitId)
    {
        return $query->where('unit_id', $unitId);
    }

    public function kriteria()
    {
        return $this->hasMany(Kriteria::class, 'indikator_id', 'indikator_id');
    }

    public function dataKinerja()
    {
        return $this->hasMany(DataKinerja::class, 'indikator_id', 'indikator_id');
    }
}