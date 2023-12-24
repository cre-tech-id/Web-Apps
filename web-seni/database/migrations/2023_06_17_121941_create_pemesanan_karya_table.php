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
        Schema::create('pemesanan_karya', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pemesan_id');
            $table->unsignedBigInteger('karya_id');
            $table->unsignedBigInteger('jumlah');
            $table->string('alamat');
            $table->string('tanggal_pemesanan');
            $table->bigInteger('total_harga');
            $table->string('status');
            $table->enum('pembayaran', ['Sudah Bayar', 'Belum Bayar']);
            $table->string('resi');
            $table->timestamps();
            $table->foreign('pemesan_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('karya_id')->references('id')->on('karya')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pemesanan_karya');
    }
};
