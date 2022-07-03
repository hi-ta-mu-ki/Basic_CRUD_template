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
        Schema::create('o2_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('o1_transactions_id');
            $table->foreign('o1_transactions_id')->references('id')->on('o1_transactions')->onDelete('cascade');
            $table->unsignedInteger('a_masters_id');
            $table->foreign('a_masters_id')->references('id')->on('a_masters')->onDelete('cascade');
            $table->unsignedInteger('quantity');
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
        Schema::dropIfExists('o2_transactions');
    }
};
