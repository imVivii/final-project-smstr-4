<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKursusTable extends Migration
{
    public function up()
    {
        Schema::create('kursus', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->text('deskripsi');
            $table->integer('harga');
            $table->string('gambar')->nullable();
            $table->string('media')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('kategori_kursus_id')->nullable(); 
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('kategori_kursus_id')->references('id')->on('kategori_kursus')->onDelete('set null'); 
        });
    }

    public function down()
    {
        Schema::dropIfExists('kursus');
    }
}
