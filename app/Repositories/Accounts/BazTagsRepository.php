<?php

namespace App\Repositories\Accounts;

use App\Contracts\Repositories\TagsRepository;

class BazTagsRepository implements TagsRepository
{
    public function all()
    {
        return [
            'Baz One',
            'Baz Two',
            'Baz Three',
            'Baz Four'
        ];
    }
}