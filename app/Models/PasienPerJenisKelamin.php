<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasienPerJenisKelamin extends Model
{
   protected $table = 'pasien_per_jenis_kelamin';

// Kolom-kolom yang bisa diisi (mass assignment)
protected $fillable = [
    'jenis_kelamin',
    'jumlah_pasien',
    'bulan',
    'tahun',
    'wilayah',
];

}
