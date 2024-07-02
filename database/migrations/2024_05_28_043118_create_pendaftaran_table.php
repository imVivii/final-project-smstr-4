<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendaftaranTable extends Migration
{
    public function up()
    {
        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->foreignId('id_kursus')->constrained('kursus')->onDelete('cascade');
            $table->enum('status_pendaftaran', ['menunggu pembayaran', 'sedang diperiksa', 'berhasil', 'gagal'])->default('menunggu pembayaran');
            $table->enum('status_kursus', ['Aktif', 'Belum Aktif'])->default('Belum Aktif');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pendaftaran');
    }
}
