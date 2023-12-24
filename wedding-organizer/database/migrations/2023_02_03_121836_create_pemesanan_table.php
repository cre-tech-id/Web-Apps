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
        Schema::create('pemesanan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pemesan_id');
            $table->unsignedBigInteger('paket_id');
            $table->string('lokasi');
            $table->string('tanggal_book');
            $table->string('status');
            $table->integer('harga_paket');
            $table->integer('pembayaran');
            $table->string('selesai');
            $table->timestamps();
            $table->foreign('pemesan_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('paket_id')->references('id')->on('paket')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pemesanan');
    }
};
