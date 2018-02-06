<?php

namespace App\Providers;

use App\Contracts\Repositories\TagsRepository;
use App\Resolvers\Repositories\TagsRepositoryResolver;
use Illuminate\Support\ServiceProvider;

class TenancyServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(TagsRepositoryResolver::getAbstract(), TagsRepositoryResolver::getConcrete());
    }
}
