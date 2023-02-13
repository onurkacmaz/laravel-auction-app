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
        Schema::create('auction_applications', function (Blueprint $table) {
            $table->id();
            $table->string('applicant_name');
            $table->text('company_name');
            $table->text('address');
            $table->string('phone');
            $table->string('email');
            $table->longText('content_1');
            $table->longText('content_2');
            $table->longText('content_3');
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
        Schema::dropIfExists('auction_applications');
    }
};
