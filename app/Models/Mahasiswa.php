<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';

    protected $fillable = [
        'nim',
        'nama',
        'serial_nfc'
    ];

    public function absensi()
    {
        return $this->hasMany(
            Absensi::class,
            'mahasiswa_id'
        );
    }
}