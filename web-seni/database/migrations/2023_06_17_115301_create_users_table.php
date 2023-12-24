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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->index();
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->string('ttl');
            $table->string('agama');
            $table->string('alamat');
            $table->string('no_hp');
            $table->string('foto');
            $table->unsignedBigInteger('role_id');
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
};