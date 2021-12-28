<?php

namespace App\Services;

use App\Cache\RedisAdapter;
use App\Services\Poetry;
use App\Services\Transformers\PoetryTransformer;
use GuzzleHttp\Client as Guzzle;

class ServiceFactory
{
    protected $client;

    protected $cache;

    protected $enabledServices = [
        'poetry',
    ];

    public function __construct(Guzzle $client, RedisAdapter $cache)
    {
        $this->client = $client;
        $this->cache = $cache;
    }

    public function get($service, $limit = 10)
    {
        if (method_exists($this, $service) && $this->serviceIsEnabled($service)) {
            return $this->sortResponseByLinecount(
                $this->{$service}($limit)
            );
        }

        return [];
    }

    protected function poetry($limit = 10)
    {
        $data = $this->cache->remember('poetry', 10, function () use ($limit) {
            return json_encode((new Poetry($this->client))->get($limit));
        });

        return (new PoetryTransformer(json_decode($data)))->create();
    }


    protected function serviceIsEnabled($service)
    {
        return in_array($service, $this->enabledServices);
    }

    protected function sortResponseByLinecount(array $data)
    {
        usort($data, function ($a, $b) {
            return $a['linecount'] - $b['linecount'];
        });

        return $data;
    }
}
