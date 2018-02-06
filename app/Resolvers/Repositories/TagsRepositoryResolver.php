<?php

namespace App\Resolvers\Repositories;

use App\Contracts\Repositories\TagsRepository;
use App\Contracts\Resolver;
use App\Repositories\Accounts\AcmeTagsRepository;
use App\Repositories\Accounts\BazTagsRepository;
use App\Repositories\Accounts\NoneAccountTagsRepository;
use Illuminate\Support\Facades\Auth;

class TagsRepositoryResolver implements Resolver
{
    /**
     * Return the abstract implementation.
     *
     * @return string
     */
    public static function getAbstract()
    {
        return TagsRepository::class;
    }

    /**
     * Return the concrete instance.
     *
     * @return \Closure
     */
    public static function getConcrete()
    {
        return function () {

            $user = Auth::user();

            switch ($user->getKey()) {
                case 1:
                    return new AcmeTagsRepository();
                case 2:
                    return new BazTagsRepository();
            }

            return new NoneAccountTagsRepository();
        };
    }
}