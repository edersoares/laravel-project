<?php

namespace App\Resolvers\Repositories;

use App\Contracts\Resolver;
use App\Repositories\Accounts\AcmeTagsRepository;
use App\Repositories\Accounts\BazTagsRepository;
use App\Repositories\Accounts\NoneAccountTagsRepository;
use Illuminate\Support\Facades\Auth;

class TagsRepositoryResolver implements Resolver
{
    public static function getResolver()
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