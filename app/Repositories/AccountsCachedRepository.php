<?php

namespace App\Repositories;

use App\Contracts\Repositories\AccountsRepository as AccountsRepositoryContract;
use Illuminate\Filesystem\Cache;

class AccountsCachedRepository implements AccountsRepositoryContract
{
    /**
     * @var AccountsRepository
     */
    protected $repository;

    /**
     * @var int
     */
    protected $expires = 10;

    /**
     * AccountsRepository constructor.
     *
     * @param AccountsRepository $repository
     *
     * @return void
     */
    public function __construct(AccountsRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param mixed $attributes
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create($attributes)
    {
        return $this->repository->create($attributes);
    }

    /**
     * @param mixed $identifier
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function browse($identifier)
    {
        return $this->repository->browse($identifier);
    }

    /**
     * @param mixed $identifier
     * @param mixed $attributes
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update($identifier, $attributes)
    {
        return $this->repository->update($identifier, $attributes);
    }

    /**
     * @param mixed $identifier
     *
     * @return \Illuminate\Database\Eloquent\Model
     *
     * @throws \Exception
     */
    public function delete($identifier)
    {
        return $this->repository->delete($identifier);
    }

    /**
     * Filter by active accounts.
     *
     * @return AccountsRepository
     */
    public function active()
    {
        return $this->repository->active();
    }

    /**
     * Filter by inactive accounts.
     *
     * @return AccountsRepository
     */
    public function inactive()
    {
        return $this->repository->inactive();
    }

    /**
     * Filter by exact slug.
     *
     * @param string $slug
     *
     * @return AccountsRepository
     */
    public function slug($slug)
    {
        return $this->repository->slug($slug);
    }

    /**
     * Filter by account name or account slug (partial for both).
     *
     * @param string $search
     *
     * @return AccountsRepository
     */
    public function search($search)
    {
        return $this->repository->search($search);
    }

    /**
     * Return all accounts.
     *
     * @return mixed
     */
    public function all()
    {
        return Cache::remember('accounts.all', $this->expires, function () {
            return $this->repository->all();
        });
    }

    /**
     * Return one account.
     *
     * @return mixed
     */
    public function one()
    {
        return Cache::remember('accounts.one', $this->expires, function () {
            return $this->repository->one();
        });
    }

    /**
     * Return the resources model paginated.
     *
     * @param int $page
     * @param int $show
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate($page = 1, $show = 10)
    {
        return $this->repository->paginate($page, $show);
    }
}