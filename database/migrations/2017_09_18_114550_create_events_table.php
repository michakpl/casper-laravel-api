<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->uuid('user_id');
            $table->foreign('user_id')->references('id')
                                      ->on('users')
                                      ->onDelete('cascade')
                                      ->onUpdate('cascade');
            $table->string('title');
            $table->string('location');
            $table->string('location_geo')->nullable();
            $table->text('description');
            $table->dateTime('starts_at');
            $table->integer('duration');
            $table->integer('guests_limit')->nullable();
            $table->dateTime('registration_ends_at');
            $table->boolean('is_private');
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
        Schema::dropIfExists('events');
    }
}
