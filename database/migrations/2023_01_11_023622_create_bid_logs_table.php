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
        Schema::create('bid_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('art_work_id')->references('id')->on('art_works');
            $table->foreignId('user_id')->references('id')->on('users');
            $table->decimal('bid_amount', 16);
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
        Schema::dropIfExists('bid_logs');
    }
};
