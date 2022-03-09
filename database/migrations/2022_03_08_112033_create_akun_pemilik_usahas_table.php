<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAkunPemilikUsahasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('akun_pemilik_usahas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pemilik');
            $table->string('nama_usaha');
            $table->string('jenis_usaha');
            $table->string('email');
            $table->string('password');
            $table->string('foto')->nullable();
            $table->text('alamat')->nullable();
            $table->string('instagram')->nullable();
            $table->string('facebook')->nullable();
            $table->string('shopee')->nullable();
            $table->string('tokopedia')->nullable();
            // $table->text('gps')->nullable();
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
        Schema::dropIfExists('akun_pemilik_usahas');
    }
}
