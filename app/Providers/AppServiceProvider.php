<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (! $this->app->environment(['production'])) {
            $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }

        $this->morphMap();
    }

    /**
     * Set the morph map for polymorphic relations.
     *
     * @return $this
     */
    protected function morphMap()
    {
        Relation::morphMap([
            \App\Accounts\Role::class,
            \App\Accounts\User::class,
            \App\Attachments\Attachment::class,
            \App\Documents\Document::class,
            \App\Zinc\Zinc::class,
        ]);

        return $this;
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
