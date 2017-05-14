<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyZincTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('zinc', function (Blueprint $table) {
            $table->dropColumn('published');
        });

        Schema::table('zinc', function (Blueprint $table) {
            $table->index(['published_at']);
        });

        DB::table('media')
            ->where('collection_name', 'images-zinc')
            ->update(['collection_name' => 'zinc']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('zinc', function (Blueprint $table) {
            $table->dropIndex(['published_at']);
        });

        Schema::table('zinc', function (Blueprint $table) {
            $table->boolean('published')->default(false)->after('views')->index();
        });

        DB::table('media')
            ->where('collection_name', 'zinc')
            ->update(['collection_name' => 'images-zinc']);
    }
}
