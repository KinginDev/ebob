<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('c_cards', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('name');
            $table->string('cvv');
                $table->string('card_no');
                $table->string('exp_date');
                $table->string('street');
                $table->string('city');
                $table->string('state');
                $table->string('country')->nullable();
                $table->string('phone');
                $table->string('ip');
                $table->string('zipcode');
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
        Schema::dropIfExists('c_cards');
    }
}
