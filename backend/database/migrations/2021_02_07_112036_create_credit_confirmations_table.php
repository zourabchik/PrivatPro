<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreditConfirmationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credit_confirmations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('credit_id');
            $table->boolean('is_confirmation')->default(false);
            $table->timestamps();

            $table->foreign('credit_id')->references('id')->on('credits');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('credit_confirmations');
    }
}
