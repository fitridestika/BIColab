<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatistikPoli extends Model
{
    use HasFactory;

    protected $table = 'statistik_poli';

    protected $fillable = [
        'jenis_penyakit',
        'jumlah_pasien',
        'bulan',
        'tahun',
        'unit_rs',
    ];
}
