<?php

namespace App\Services;

use App\Services\Poetry;
use App\Services\Transformers\PoetryTransformer;
use GuzzleHttp\Client as Guzzle;

class ServiceFactory
{
    protected $client;

    public function __construct(Guzzle $client)
    {
        $this->client = $client;
    }

    public function get($service, $limit = 10)
    {
        if (method_exists($this, $service)) {
            return $this->sortResponseByLinecount(
                $this->{$service}($limit)
            );
        }
    }

    protected function poetry($limit = 10)
    {
        $data = (new Poetry($this->client))->get($limit);

        return (new PoetryTransformer($data))->create();
    }

    protected function sortResponseByLinecount(array $data)
    {
        usort($data, function ($a, $b) {
            return $a['linecount'] - $b['linecount'];
        });

        return $data;
    }
}
