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
        Schema::create('pemesanan_kesenian', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pemesan_id');
            $table->unsignedBigInteger('kesenian_id');
            $table->string('lokasi');
            $table->string('tanggal_book');
            $table->string('status');
            $table->string('pembayaran');
            $table->timestamps();
            $table->foreign('pemesan_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('kesenian_id')->references('id')->on('kesenian')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pemesanan_kesenian');
    }
};
