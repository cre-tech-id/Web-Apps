<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('karya', function (Blueprint $table) {
            $table->id();
            $table->string('nama_karya');
            $table->unsignedBigInteger('id_seniman');
            $table->longText('deskripsi');
            $table->Text('kategori');
            $table->string('harga');
            $table->bigInteger('stok');
            $table->string('foto');
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
        Schema::dropIfExists('karya');
    }
};