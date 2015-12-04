<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZincTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zinc', function (Blueprint $table) {
            $table->increments('id');
            $table->smallInteger('year')->unsigned();
            $table->tinyInteger('month')->unsigned();
            $table->string('topic');
            $table->mediumInteger('views')->unsigned()->default(0);
            $table->boolean('published')->default(false);
            $table->timestamp('published_at')->nullable();

            $table->unique(['year', 'month']);

            $table->index('published');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('zinc');
    }
}
