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
            $table->string('source', 255)->nullable();;
            $table->string('destination', 255)->nullable();;
            $table->string('longitude', 255)->nullable();;
            $table->string('latitude', 255)->nullable();;
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

