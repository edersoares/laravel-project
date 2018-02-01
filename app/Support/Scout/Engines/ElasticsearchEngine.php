<?php

namespace App\Support\Scout\Engines;

use Elasticsearch\Client;
use Laravel\Scout\Builder;
use Laravel\Scout\Engines\Engine;

class ElasticsearchEngine extends Engine
{
    /**
     * Elasticsearch client.
     *
     * @var Client
     */
    protected $client;

    /**
     * ElasticsearchEngine constructor.
     *
     * @param Client $client
     *
     * @return void
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Return the index name.
     *
     * @return string
     */
    protected function getIndex()
    {
        return config('scout.elasticsearch.index');
    }

    /**
     * Update the given model in the index.
     *
     * @param  \Illuminate\Database\Eloquent\Collection $models
     * @return void
     */
    public function update($models)
    {
        $models->each(function ($model) {

            $params = [
                'index' => $this->getIndex(),
                'type' => $model->searchableAs(),
                'id' => $model->getKey(),
                'body' => $model->toSearchableArray()
            ];

            $this->client->index($params);
        });
    }

    /**
     * Remove the given model from the index.
     *
     * @param  \Illuminate\Database\Eloquent\Collection $models
     * @return void
     */
    public function delete($models)
    {
        $models->each(function ($model) {

            $params = [
                'index' => $this->getIndex(),
                'type' => $model->searchableAs(),
                'id' => $model->getKey()
            ];

            $this->client->delete($params);
        });
    }

    /**
     * Perform the given search on the engine.
     *
     * @param  \Laravel\Scout\Builder $builder
     * @return mixed
     */
    public function search(Builder $builder)
    {
        $params = [
            'index' => $this->getIndex(),
            'type' => $builder->model->searchableAs(),
            'body' => [
                'query' => [
                    'match' => [
                        'name' => 'abc'
                    ]
                ]
            ]
        ];

        return $this->client->search($params);
    }

    /**
     * Perform the given search on the engine.
     *
     * @param  \Laravel\Scout\Builder $builder
     * @param  int $perPage
     * @param  int $page
     * @return mixed
     */
    public function paginate(Builder $builder, $perPage, $page)
    {
        // TODO: Implement paginate() method.
    }

    /**
     * Pluck and return the primary keys of the given results.
     *
     * @param  mixed $results
     * @return \Illuminate\Support\Collection
     */
    public function mapIds($results)
    {
        // TODO: Implement mapIds() method.
    }

    /**
     * Map the given results to instances of the given model.
     *
     * @param  mixed $results
     * @param  \Illuminate\Database\Eloquent\Model $model
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function map($results, $model)
    {
        // TODO: Implement map() method.
    }

    /**
     * Get the total count from a raw result returned by the engine.
     *
     * @param  mixed $results
     * @return int
     */
    public function getTotalCount($results)
    {
        // TODO: Implement getTotalCount() method.
    }
}