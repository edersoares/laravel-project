<?php

namespace App\Providers;

use App\Resolvers\Repositories\AccountsRepositoryResolver;
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
    }
}
