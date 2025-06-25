<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatistikPenyakit extends Model
{
    use HasFactory;

    protected $table = 'statistik_penyakit';

    protected $fillable = [
        'jenis_penyakit',
        'jumlah_pasien',
        'bulan',
        'tahun',
        'unit_rs',
    ];
}
