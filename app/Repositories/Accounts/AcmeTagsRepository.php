<?php

namespace App\Repositories\Accounts;

use App\Contracts\Repositories\TagsRepository;

class AcmeTagsRepository implements TagsRepository
{
    public function all()
    {
        return [
            'Acme One',
            'Acme Two'
        ];
    }
}