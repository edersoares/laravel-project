<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Repositories\TagsRepository;
use App\Http\Controllers\Controller;

class TenancyController extends Controller
{
    public function tags(TagsRepository $repository)
    {
        return $repository->all();
    }
}
