<?php

namespace App\Support\Scout\Engines;

use Elasticsearch\Client;
use Illuminate\Database\Eloquent\Collection;
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
        $params = [
            'index' => $this->getIndex(),
            'type' => $models->first()->searchableAs(),
            'body' => []
        ];

        foreach ($models as $model) {

            $params['body'][] = [
                'index' => [
                    '_id' => $model->getKey()
                ]
            ];

            $params['body'][] = $model->toSearchableArray();
        }

        $this->client->bulk($params);
    }

    /**
     * Remove the given model from the index.
     *
     * @param  \Illuminate\Database\Eloquent\Collection $models
     * @return void
     */
    public function delete($models)
    {
        $params = [
            'index' => $this->getIndex(),
            'type' => $models->first()->searchableAs(),
            'body' => []
        ];

        foreach ($models as $model) {
            $params['body'][] = [
                'delete' => [
                    '_id' => $model->getKey()
                ]
            ];
        }

        $this->client->bulk($params);
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
            'q' => $builder->query
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
        $params = [
            'index' => $this->getIndex(),
            'type' => $builder->model->searchableAs(),
            'size' => $perPage,
            'from' => $page * $perPage - $perPage,
            'q' => $builder->query
        ];

        return $this->client->search($params);
    }

    /**
     * Pluck and return the primary keys of the given results.
     *
     * @param  mixed $results
     * @return \Illuminate\Support\Collection
     */
    public function mapIds($results)
    {
        return array_map(function ($item) {
            return $item['_id'];
        }, $results['hits']['hits']);
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
        if (count($results['hits']['hits']) === 0) {
            return Collection::make();
        }

        $data = array_map(function ($item) {
            return $item['_source'];
        }, $results['hits']['hits']);

        return $model::hydrate($data);
    }

    /**
     * Get the total count from a raw result returned by the engine.
     *
     * @param  mixed $results
     * @return int
     */
    public function getTotalCount($results)
    {
        return $results['hits']['total'];
    }
}