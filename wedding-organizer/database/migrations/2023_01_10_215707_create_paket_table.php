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
        Schema::dropIfExists('paket');

        Schema::create('paket', function (Blueprint $table) {
            $table->id();
            $table->string('nama_paket');
            $table->unsignedBigInteger('penyedia_id');
            $table->text('detail');
            $table->integer('harga');
            $table->integer('min_dp');
            $table->string('gambar');
            $table->string('status');
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
        Schema::dropIfExists('paket');
    }
};
