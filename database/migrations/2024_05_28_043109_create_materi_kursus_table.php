<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMateriKursusTable extends Migration
{
    public function up()
    {
        Schema::create('materi_kursus', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->text('deskripsi')->nullable();
            $table->string('materi')->nullable();
            $table->foreignId('id_kursus')->constrained('kursus')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('materi_kursus');
    }
}
