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
        Schema::create('o1_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('b_masters_id');
            $table->foreign('b_masters_id')->references('id')->on('b_masters')->onDelete('cascade');
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
        Schema::dropIfExists('o1_transactions');
    }
};
