<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTableAtUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('nim')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('alamat_solo')->nullable();
            $table->integer('prodis_id')->nullable();
            $table->string('fakultas')->nullable();
            $table->integer('angkatan')->nullable();
            $table->longText('deskripsi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('nim');
            $table->dropColumn('tempat_lahir');
            $table->dropColumn('tanggal_lahir');
            $table->dropColumn('alamat_solo');
            $table->dropColumn('prodis_id');
            $table->dropColumn('fakultas');
            $table->dropColumn('angkatan');
            $table->dropColumn('deskripsi');
        
        });
    }
}
