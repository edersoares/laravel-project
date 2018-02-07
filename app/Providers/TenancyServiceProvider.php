<?php

namespace App\Providers;

use App\Contracts\Repositories\AccountsRepository;
use App\Contracts\Repositories\TagsRepository;
use App\Resolvers\Repositories\AccountsRepositoryResolver;
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
        $this->app->bind(AccountsRepositoryResolver::getAbstract(), AccountsRepositoryResolver::getConcrete());
        $this->app->bind(TagsRepositoryResolver::getAbstract(), TagsRepositoryResolver::getConcrete());
    }
}
