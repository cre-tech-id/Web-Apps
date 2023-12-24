<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableSchedule extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('teachs_id')->nullable();
            $table->integer('dosen_id')->nullable();
            $table->integer('matkul_id')->nullable();
            $table->integer('days_id')->nullable();
            $table->integer('times_id')->nullable();
            $table->integer('rooms_id')->nullable();
            $table->string('type')->nullable();
            $table->string('value')->nullable();
            $table->string('value_process')->nullable();
            $table->string('log')->nullable();
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
        Schema::dropIfExists('schedules');
    }
}
