<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ArticleServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Repositories\ArticleRepositoryInterface', 'App\Repositories\ArticleRepository');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
