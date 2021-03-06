<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventGuestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_guests', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('user_id');
            $table->foreign('user_id')->references('id')
                                      ->on('users')
                                      ->onDelete('cascade')
                                      ->onUpdate('cascade');
            $table->uuid('event_id');
            $table->foreign('event_id')->references('id')
                                      ->on('events')
                                      ->onDelete('cascade')
                                      ->onUpdate('cascade');
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
        Schema::dropIfExists('event_guests');
    }
}
