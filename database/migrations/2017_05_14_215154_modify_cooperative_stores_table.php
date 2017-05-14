<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyCooperativeStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $css = DB::table('cooperative_stores')->get();

        Schema::table('cooperative_stores', function (Blueprint $table) {
            $table->dropIndex(['published', 'group']);

            $table->dropColumn('published');
        });

        Schema::table('cooperative_stores', function (Blueprint $table) {
            $table->timestamp('published_at')->nullable();
            $table->timestamps();

            $table->index(['published_at', 'group']);
        });

        $css->each(function ($cs) {
            $now = Carbon::now();

            DB::table('cooperative_stores')
                ->where('id', $cs->id)
                ->update([
                    'published_at' => $cs->published ? $now : null,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $css = DB::table('cooperative_stores')->get();

        Schema::table('cooperative_stores', function (Blueprint $table) {
            $table->dropIndex(['published_at', 'group']);

            $table->dropColumn('published_at');
            $table->dropTimestamps();
        });

        Schema::table('cooperative_stores', function (Blueprint $table) {
            $table->boolean('published')->default(false);

            $table->index(['published', 'group']);
        });

        $css->each(function ($cs) {
            DB::table('cooperative_stores')
                ->where('id', $cs->id)
                ->update([
                    'published' => is_null($cs->published_at) ? 0 : 1,
                ]);
        });
    }
}
