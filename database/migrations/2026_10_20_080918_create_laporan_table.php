<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('laporan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pelapor');
            $table->string('no_hp'); // PASTIKAN BARIS INI ADA
            $table->string('lokasi');
            $table->string('kecamatan');
            $table->integer('tinggi_air');
            $table->text('keterangan')->nullable();
            $table->string('foto');
            $table->string('status')->default('Menunggu');
            $table->timestamps();
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('laporan');
    }
};