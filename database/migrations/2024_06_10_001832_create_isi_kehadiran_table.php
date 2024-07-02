<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIsiKehadiranTable extends Migration
{
    public function up()
    {
        Schema::create('isi_kehadiran', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kehadiran_id');
            $table->unsignedBigInteger('user_id');
            $table->enum('status', ['hadir', 'tidak hadir']);
            $table->timestamps();

            $table->foreign('kehadiran_id')->references('id')->on('kehadiran')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('isi_kehadiran');
    }
}
