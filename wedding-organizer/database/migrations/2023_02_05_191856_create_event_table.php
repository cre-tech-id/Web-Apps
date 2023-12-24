<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('penyedia_id');
            $table->string('nama_event');
            $table->string('tanggal');
            $table->string('lokasi');
            $table->text('deskripsi');
            $table->string('gambar');
            $table->timestamps();
            $table->foreign('penyedia_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event');
    }
};
