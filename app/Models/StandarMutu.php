<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StandarMutu extends Model
{
    protected $table = 'standar_mutu';
    protected $primaryKey = 'standar_id';
    public $timestamps = false;

    protected $fillable = [
        'unit_id',
        'nama_standar',
        'kategori',
        'deskripsi'
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id', 'unit_id');
    }

    public function indikatorKinerja()
    {
        return $this->hasMany(IndikatorKinerja::class, 'standar_id', 'standar_id');
    }

    public function scopeForUnit($query, $unitId)
    {
        return $query->where('unit_id', $unitId);
    }
}