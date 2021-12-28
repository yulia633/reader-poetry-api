<?php

namespace App\Services\Transformers;

class PoetryTransformer extends TransformerAbstract
{
    public function transform($payload)
    {
        foreach ($payload as $key => $value) {
            return [
                'title' => $value->title,
                'link' => isset($value->url) ? $value->url : 'https://poetrydb.org/author' . $value->author,
                'author' => $value->author,
                'lines' => $value->lines,
                'linecount' => $value->linecount,
                'service' => 'Poetry db'
            ];
        }
    }
}
