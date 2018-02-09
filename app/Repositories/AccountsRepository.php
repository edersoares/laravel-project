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

    public function storage($storage = null)
    {
        return new Account();
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

    public function paginate($page, $show)
    {
        return $this->criteria(function ($builder) use ($page, $show) {
            $builder->limit($show);
            $builder->offset($show * $page - $show);
        });
    }
}