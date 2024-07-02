<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKehadiranTable extends Migration
{
    public function up()
    {
        Schema::create('kehadiran', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kursus_id');
            $table->date('tanggal');
            $table->timestamps();

            $table->foreign('kursus_id')->references('id')->on('kursus')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('kehadiran');
    }
}
