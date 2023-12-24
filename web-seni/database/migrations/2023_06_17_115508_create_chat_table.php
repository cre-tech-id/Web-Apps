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
        Schema::create('chat', function (Blueprint $table) {
            $table->id();
            $table->longText('pesan');
            $table->unsignedBigInteger('sender');
            $table->unsignedBigInteger('reciever');
            $table->timestamps();
            $table->foreign('sender')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('reciever')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chat');
    }
};
