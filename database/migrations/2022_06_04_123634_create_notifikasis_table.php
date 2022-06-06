<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotifikasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifikasis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_komentar');
            $table->unsignedBigInteger('id_artikel');
            $table->boolean('is_read_admin');
            $table->boolean('is_read_pemilik');
            $table->foreign('id_komentar')->references('id')->on('komentars')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('id_artikel')->references('id')->on('konten_artikels')->onDelete('CASCADE')->onUpdate('CASCADE');
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
        Schema::dropIfExists('notifikasis');
    }
}
