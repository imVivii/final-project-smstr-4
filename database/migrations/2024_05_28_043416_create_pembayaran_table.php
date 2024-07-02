<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembayaranTable extends Migration
{
    public function up()
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->foreignId('id_kursus')->constrained('kursus')->onDelete('cascade');
            $table->unsignedBigInteger('jumlah_pembayaran');
            $table->string('bukti_pembayaran')->nullable();
            $table->enum('status_pembayaran', ['sedang diperiksa', 'berhasil', 'dikembalikan'])->default('sedang diperiksa');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pembayaran');
    }
}
