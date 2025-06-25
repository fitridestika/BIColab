<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KunjunganPasien extends Model
{
    use HasFactory;

    protected $table = 'kunjungan_pasien';

    protected $fillable = [
        'bulan',
        'tahun',
        'pasien_baru',
        'pasien_lama',
        'total_kunjungan'
    ];
}
