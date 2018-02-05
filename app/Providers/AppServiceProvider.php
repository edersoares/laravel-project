<?php

namespace App\Providers;

use App\Support\Scout\EngineManager as ScoutEngineManager;
use App\Support\Scout\Engines\ElasticsearchEngine;
use Elasticsearch\ClientBuilder;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Laravel\Scout\EngineManager;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Route::pattern('id', '[0-9]+');

        Route::macro('api', function ($endpoint, $controller) {
            Route::get($endpoint, "{$controller}@index")->name("{$endpoint}.index");
            Route::post($endpoint, "{$controller}@create")->name("{$endpoint}.create");
            Route::get("{$endpoint}/{id}", "{$controller}@browse")->name("{$endpoint}.browse");
            Route::put("{$endpoint}/{id}", "{$controller}@update")->name("{$endpoint}.update");
            Route::delete("{$endpoint}/{id}", "{$controller}@delete")->name("{$endpoint}.delete");
        });

        resolve(EngineManager::class)->extend('elasticsearch', function () {

            $client = ClientBuilder::create()
                ->setHosts(config('scout.elasticsearch.hosts'))
                ->build();

            return new ElasticsearchEngine($client);
        });
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
