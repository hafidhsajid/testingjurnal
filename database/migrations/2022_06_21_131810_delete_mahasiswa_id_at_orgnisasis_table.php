<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteMahasiswaIdAtOrgnisasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('organisasis', function (Blueprint $table) {
          $table->dropColumn('mahasiswa_id');  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('organisasis', function (Blueprint $table) {
            $table->integer('mahasiswa_id');
        });
    }
}
