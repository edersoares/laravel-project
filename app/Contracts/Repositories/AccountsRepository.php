<?php

namespace App\Contracts\Repositories;

use App\Contracts\Repository;

interface AccountsRepository extends Repository
{
    public function active();

    public function inactive();

    public function slug($slug);
}