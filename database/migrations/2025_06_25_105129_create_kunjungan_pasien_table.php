<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('kunjungan_pasien', function (Blueprint $table) {
            $table->id();
            $table->string('bulan');
            $table->integer('pasien_baru');
            $table->integer('pasien_lama');
            $table->integer('total_kunjungan');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kunjungan_pasien');
    }
};
