<?php

namespace App\Support\Scout;

use App\Support\Scout\Engines\ElasticsearchEngine;
use Elasticsearch\ClientBuilder;
use Laravel\Scout\EngineManager as ScoutEngineManager;

class EngineManager extends ScoutEngineManager
{
    /**
     * Create an Elasticsearch engine instance.
     *
     * @return ElasticsearchEngine
     */
    public function createElasticsearchDriver()
    {
        $client = ClientBuilder::create()
            ->setHosts(config('scout.elasticsearch.hosts'))
            ->build();

        return new ElasticsearchEngine($client);
    }
}