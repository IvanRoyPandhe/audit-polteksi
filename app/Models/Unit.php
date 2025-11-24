<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $table = 'unit';
    protected $primaryKey = 'unit_id';
    public $timestamps = false;

    protected $fillable = [
        'nama_unit',
        'tipe_unit',
        'pimpinan'
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'unit_id', 'unit_id');
    }

    public function standarMutu()
    {
        return $this->hasMany(StandarMutu::class, 'unit_id', 'unit_id');
    }

    public function indikatorKinerja()
    {
        return $this->hasMany(IndikatorKinerja::class, 'unit_id', 'unit_id');
    }

    public function kriteria()
    {
        return $this->hasMany(Kriteria::class, 'unit_id', 'unit_id');
    }
}