<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKepanitiaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kepanitiaans', function (Blueprint $table) {
            $table->id();
            $table->integer('mahasiswa_id');
            $table->string('penyelenggara');
            $table->string('nama_acara');
            $table->string('nama_jabatan');
            $table->string('divisi');
            $table->date('waktu_mulai');
            $table->date('waktu_selesai')->nullable();
            $table->string('lokasi');
            $table->longText('deskripsi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kepanitiaans');
    }
}
