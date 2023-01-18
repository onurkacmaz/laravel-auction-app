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
        Schema::table('art_works', function (Blueprint $table) {
            $table->decimal('start_price', 16);
            $table->decimal('end_price', 16);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('art_works', function (Blueprint $table) {
            $table->dropColumn('start_price');
            $table->dropColumn('end_price');
        });
    }
};
