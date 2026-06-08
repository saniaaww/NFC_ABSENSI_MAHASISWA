<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    protected $table = 'absensi';

    protected $fillable = [
        'mahasiswa_id',
        'waktu_absen'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(
            Mahasiswa::class,
            'mahasiswa_id'
        );
    }
}