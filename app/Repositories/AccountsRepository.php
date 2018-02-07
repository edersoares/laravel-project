<?php

namespace App\Repositories;

use App\Account;
use App\Contracts\Repositories\AccountsRepository as AccountsRepositoryContract;

class AccountsRepository implements AccountsRepositoryContract
{
    public function storage($storage = null)
    {
        return new Account();
    }

    public function active()
    {
        // TODO: Implement active() method.
    }

    public function inactive()
    {
        // TODO: Implement inactive() method.
    }

    public function slug($slug)
    {
        // TODO: Implement slug() method.
    }

    public function all()
    {
        return $this->storage()->newQuery()->paginate();
    }

    public function one()
    {
        return $this->storage()->newQuery()->first();
    }
}