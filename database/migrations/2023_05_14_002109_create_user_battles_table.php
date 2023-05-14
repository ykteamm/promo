<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserBattlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_battles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('u1id');
            $table->foreignId('u2id');
            $table->integer('money1')->nullable();
            $table->integer('money2')->nullable();
            $table->foreignId('win')->nullable();
            $table->foreignId('lose')->nullable();
            $table->integer('promo_ball1')->nullable();
            $table->integer('promo_ball2')->nullable();
            $table->date('start_day');
            $table->date('end_day');
            $table->integer('ends')->default(0);
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
        Schema::dropIfExists('user_battles');
    }
}
