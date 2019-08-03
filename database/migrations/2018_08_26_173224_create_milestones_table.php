<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMilestonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('milestones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('creator_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('escrow_id')->nullable();
            $table->string('amount')->nullable();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('is_read')->default(0);
            $table->string('code')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('milestones');
    }
}
