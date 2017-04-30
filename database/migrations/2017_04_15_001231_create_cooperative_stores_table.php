<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCooperativeStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cooperative_stores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 191);
            $table->date('began_at');
            $table->date('ended_at');
            $table->string('phone', 16);
            $table->string('address', 64);
            $table->string('description', 5000);
            $table->string('business_hours', 2000);
            $table->string('group', 48)->index();
            $table->boolean('published')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cooperative_stores');
    }
}
