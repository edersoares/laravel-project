<?php

namespace App\Contracts\Repositories;

use App\Contracts\Repository;

interface AccountsRepository extends Repository
{
    /**
     * Filter by active accounts.
     *
     * @return $this
     */
    public function active();

    /**
     * Filter by inactive accounts.
     *
     * @return $this
     */
    public function inactive();

    /**
     * Filter by exact slug.
     *
     * @param string $slug
     *
     * @return $this
     */
    public function slug($slug);

    /**
     * Filter by account name or account slug (partial for both).

     * @param string $search
     *
     * @return $this
     */
    public function search($search);
}