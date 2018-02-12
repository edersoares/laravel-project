<?php

namespace Nix\Repository;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

abstract class Eloquent
{
    /**
     * @var array
     */
    protected $criteria;

    /**
     * @var array
     */
    protected $scopes;

    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     */
    public function __construct(Model $model)
    {
        $this->criteria = [];
        $this->scopes = [];
        $this->model = $model;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function newModel()
    {
        $model = get_class($this->model);

        return new $model;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function newBuilder()
    {
        $builder = $this->newModel()->newQuery();

        foreach ($this->scopes as $scope) {
            $scope($builder);
        }

        while ($criteria = array_pop($this->criteria)) {
            $criteria($builder);
        }

        return $builder;
    }

    /**
     * @param mixed $attributes
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create($attributes)
    {
        $model = $this->newModel();

        $model->fill($attributes);
        $model->save();

        return $model;
    }

    /**
     * @param mixed $identifier
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function browse($identifier)
    {
        return $this->criteria(function ($builder) use ($identifier) {
            $builder->whereKey($identifier);
        })->one();
    }

    /**
     * @param mixed $identifier
     * @param mixed $attributes
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update($identifier, $attributes)
    {
        $model = $this->browse($identifier);

        $model->fill($attributes);
        $model->save();

        return $model;
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
        $model = $this->browse($identifier);

        $model->delete();

        return $model;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function one()
    {
        return $this->newBuilder()->first();
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->newBuilder()->get();
    }

    /**
     * @param mixed $criteria
     *
     * @return $this
     */
    public function criteria($criteria)
    {
        $this->criteria[] = $criteria;

        return $this;
    }

    /**
     * @param mixed $scope
     *
     * @return $this
     */
    public function scope($scope)
    {
        $this->scopes[] = $scope;

        return $this;
    }

    /**
     * @param int $page
     * @param int $show
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate($page = 1, $show = 25)
    {
        return $this->newBuilder()->paginate($show, ['*'], 'page', $page);
    }
}