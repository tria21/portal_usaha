<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSosmedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sosmeds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->text('nama_sosmed');
            $table->string('link_sosmed');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('CASCADE')->onUpdate('CASCADE');
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
        Schema::dropIfExists('sosmeds');
    }
}
