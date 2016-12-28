<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContributionSemesterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contribution_semester', function (Blueprint $table) {
            $table->unsignedInteger('contribution_id');
            $table->unsignedInteger('semester_id');

            $table->primary(['contribution_id', 'semester_id']);

            $table->foreign('contribution_id')->references('id')->on('contributions')->onUpdate('cascade');
            $table->foreign('semester_id')->references('id')->on('semesters')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('contribution_semester');
    }
}
