<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->integer('mahasiswa_id');
            $table->string('jabatan');
            $table->integer('jabatans_id');
            $table->string('perusahaan');
            $table->string('lokasi_perusahaan');
            $table->date('waktu_mulai');
            $table->date('waktu_selesai')->nullable();
            $table->string('bidang');
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
        Schema::dropIfExists('experiences');
    }
}
