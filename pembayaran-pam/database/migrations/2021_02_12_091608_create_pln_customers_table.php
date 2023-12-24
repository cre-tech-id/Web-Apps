<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlnCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pln_customers', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pelanggan', 100);
            $table->char('nomor_meter', 12)->unique();
            $table->text('alamat');
            $table->foreignId('id_tarif')->default(null)->constrained('tariffs');
            $table->enum('status', ['0', '1']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pln_customers');
    }
}
