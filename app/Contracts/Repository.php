<?php

namespace App\Contracts;

interface Repository
{
    /**
     * Return one resource model.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function one();

    /**
     * Return all resouces model in a collection.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all();

    /**
     * Return the resources model paginated.
     *
     * @param int $page
     * @param int $show
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate($page, $show);
}