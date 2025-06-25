<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePasienPerJenisKelaminTable extends Migration
{
public function up(): void
{
Schema::create('pasien_per_jenis_kelamin', function (Blueprint $table) {
$table->id(); // Primary key: id otomatis bertambah
$table->string('jenis_kelamin', 20); // Laki-laki, Perempuan, atau Lainnya
$table->integer('jumlah_pasien'); // Jumlah pasien dalam kategori tersebut
$table->unsignedTinyInteger('bulan'); // 1-12 (Januari s/d Desember)
$table->unsignedSmallInteger('tahun'); // Contoh: 2024, 2025
$table->string('wilayah')->nullable(); // Bisa diisi nama kecamatan/unit pelayanan
$table->timestamps(); // created_at dan updated_at otomatis
});
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
{
    Schema::dropIfExists('pasien_per_jenis_kelamin');
}
};
