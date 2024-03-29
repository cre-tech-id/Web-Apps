<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('kota');
            $table->string('kecamatan');
            $table->string('desa');
            $table->string('detail_alamat');
            $table->string('no_hp');
            $table->string('gambar');
            $table->string('desc');
            $table->unsignedBigInteger('role_id');
            $table->enum('is_verify',['0','1','2'])->default('0');
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('role_id')->references('id')->on('role')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
