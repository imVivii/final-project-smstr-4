<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenilaianTable extends Migration
{
    public function up()
    {
        Schema::create('penilaian', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pengumpulan_tugas_id');
            $table->unsignedBigInteger('guru_id');
            $table->integer('nilai');
            $table->text('komentar')->nullable();
            $table->timestamps();

            $table->foreign('pengumpulan_tugas_id')->references('id')->on('pengumpulan_tugas')->onDelete('cascade');
            $table->foreign('guru_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('penilaian');
    }
}
