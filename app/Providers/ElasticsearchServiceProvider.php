<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;
use App\Repositories\ElasticsearchArticleRepositoryInterface;
use App\Repositories\EloquentArticlesRepository;
use App\Repositories\ElasticsearchArticleRepository;

class ElasticsearchServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ElasticsearchArticleRepositoryInterface::class, function($app) {
            if (!config('services.search.enabled')) {
                return new EloquentArticlesRepository();
            }
            return new ElasticsearchArticleRepository(
                $app->make(Client::class)
            );
        });

        $this->bindSearchClient();
    }

    private function bindSearchClient()
    {
        $this->app->bind(Client::class, function ($app) {
            return ClientBuilder::create()
                ->setHosts(config('services.search.hosts'))
                ->build();
        });
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
