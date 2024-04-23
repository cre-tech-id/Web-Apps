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
        Schema::table('level_permission', function (Blueprint $table) {
            $table->foreign(['id_level'])->references(['id'])->on('levels')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['id_permission'])->references(['id'])->on('permissions')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('level_permission', function (Blueprint $table) {
            $table->dropForeign('level_permission_id_level_foreign');
            $table->dropForeign('level_permission_id_permission_foreign');
        });
    }
};
