
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StatistikPoli extends Migration
{
    public function up()
    {
        Schema::create('statistik_poli', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_penyakit');
            $table->integer('jumlah_pasien');
            $table->tinyInteger('bulan'); // 1 - 12
            $table->year('tahun');
            $table->string('unit_rs')->nullable(); // opsional
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('statistik_poli');
    }
}