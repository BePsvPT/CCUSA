<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContributionEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contribution_event', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('contribution_id');
            $table->unsignedInteger('event_id');
            $table->string('phone', 16)->nullable();
            $table->string('email', 48)->nullable();
            $table->timestamp('triggered_at')->nullable();
            $table->timestamps();

            $table->unique(['contribution_id', 'event_id']);

            $table->foreign('contribution_id')->references('id')->on('contributions')->onUpdate('cascade');
            $table->foreign('event_id')->references('id')->on('events')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('contribution_event');
    }
}
