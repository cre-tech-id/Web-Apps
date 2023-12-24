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
        Schema::create('kesenian', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kesenian');
            $table->unsignedBigInteger('id_seniman');
            $table->longText('deskripsi');
            $table->Text('kategori');
            $table->string('harga');
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
        Schema::dropIfExists('kesenian');
    }
};