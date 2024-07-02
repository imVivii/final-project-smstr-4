<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTugasTable extends Migration
{
    public function up()
    {
        Schema::create('tugas', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('deskripsi');
            $table->date('tanggal_deadline');
            $table->unsignedBigInteger('kursus_id');
            $table->timestamps();

            $table->foreign('kursus_id')->references('id')->on('kursus')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tugas');
    }

    public function create(Request $request)
    {
        $tugas = Tugas::findOrFail($request->tugas_id);
        return view('siswa.pengumpulan_tugas.create', compact('tugas'));
    }
}
