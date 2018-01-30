<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
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
        Route::macro('api', function ($endpoint, $controller) {
            Route::get($endpoint, "{$controller}@index")->name("{$endpoint}.index");
            Route::post($endpoint, "{$controller}@create")->name("{$endpoint}.create");
            Route::get("{$endpoint}/{id}", "{$controller}@browse")->name("{$endpoint}.browse");
            Route::put("{$endpoint}/{id}", "{$controller}@update")->name("{$endpoint}.update");
            Route::delete("{$endpoint}/{id}", "{$controller}@delete")->name("{$endpoint}.delete");
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
