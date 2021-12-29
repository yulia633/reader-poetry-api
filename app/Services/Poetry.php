<?php

namespace App\Services;

class Poetry extends ServiceAbstract
{
    public function get($limit = 30)
    {
        $response = $this->client->request('GET', 'https://poetrydb.org/author');
        $ids = json_decode($response->getBody());
        $authors = array_slice($ids->authors, 0, $limit);

        $poetry = [];
        foreach ($authors as $id) {
            $poetry[] = json_decode(
                $this->client->request('GET', 'https://poetrydb.org/author/' . $id)->getBody()
            );
        }
        return $poetry;
    }
}
