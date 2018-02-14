<?php

namespace App\Repositories;

use App\Account;
use App\Contracts\Repositories\AccountsRepository as AccountsRepositoryContract;
use Nix\Repository\Eloquent;

class AccountsRepository extends Eloquent implements AccountsRepositoryContract
{
    /**
     * AccountsRepository constructor.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct(new Account());
    }

    /**
     * Filter by active accounts.
     *
     * @return $this
     */
    public function active()
    {
        return $this->criteria(function ($builder) {
            $builder->where('active', true);
        });
    }

    /**
     * Filter by inactive accounts.
     *
     * @return $this
     */
    public function inactive()
    {
        return $this->criteria(function ($builder) {
            $builder->where('active', false);
        });
    }

    /**
     * Filter by exact slug.
     *
     * @param string $slug
     *
     * @return $this
     */
    public function slug($slug)
    {
        return $this->criteria(function ($builder) use ($slug) {
            $builder->where('slug', $slug);
        });
    }

    /**
     * Filter by account name or account slug (partial for both).
     *
     * @param string $search
     *
     * @return $this
     */
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