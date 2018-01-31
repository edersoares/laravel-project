<?php

namespace App\Repositories\Accounts;

use App\Contracts\Repositories\TagsRepository;

class NoneAccountTagsRepository implements TagsRepository
{
    public function all()
    {
        return [];
    }
}