<?php

namespace App\Resolvers\Repositories;

use App\Contracts\Repositories\AccountsRepository;
use App\Contracts\Resolver;
use App\Repositories\AccountsRepository as Repository;
use App\Repositories\AccountsCacheRepository as CacheRepository;

class AccountsRepositoryResolver implements Resolver
{
    /**
     * Return the abstract implementation.
     *
     * @return string
     */
    public static function getAbstract()
    {
        return AccountsRepository::class;
    }

    /**
     * Return the concrete instance.
     *
     * @return \Closure
     */
    public static function getConcrete()
    {
        return function () {
            return new CacheRepository(new Repository());
        };
    }
}