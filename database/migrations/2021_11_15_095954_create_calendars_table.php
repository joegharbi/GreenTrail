<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalendarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendars', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->string('source', 255)->nullable();
            $table->string('destination', 255)->nullable();
            $table->string('from_lat', 255)->nullable();
            $table->string('from_lng', 255)->nullable();
            $table->string('to_lat', 255)->nullable();
            $table->string('to_lng', 255)->nullable();
            $table->string('state', 255)->default('pending');
            $table->string('chosen_transportation', 255)->nullable();
            $table->integer('reduced_emission')->default(0);
            $table->string('rdate', 255);
            $table->string('comments', 255);
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calendars');
    }
}
