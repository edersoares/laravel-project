<?php

namespace App\Repositories;

use App\Account;
use App\Contracts\Repositories\AccountsRepository as AccountsRepositoryContract;
use Nix\Repository\Eloquent;

class AccountsRepository extends Eloquent implements AccountsRepositoryContract
{
    public function __construct()
    {
        parent::__construct(new Account());
    }

    public function active()
    {
        return $this->criteria(function ($builder) {
            $builder->where('active', true);
        });
    }

    public function inactive()
    {
        return $this->criteria(function ($builder) {
            $builder->where('active', false);
        });
    }

    public function slug($slug)
    {
        return $this->criteria(function ($builder) use ($slug) {
            $builder->where('slug', $slug);
        });
    }

    public function search($search)
    {
        return $this->criteria(function ($builder) use ($search) {
            $builder->where(function ($builder) use ($search) {
                $builder->where('name', 'like', "%{$search}%");
                $builder->orWhere('name', 'like', "%{$search}%");
            });
        });
    }
}