<?php

namespace App\Services\Transformers;

class PoetryTransformer extends TransformerAbstract
{
    public function transform($payload)
    {
        foreach ($payload as $key => $value) {
            return [
                'title' => $value->title,
                'link' => isset($value->url) ? $value->url : 'https://poetrydb.org/author/' . $value->author,
                'author' => $value->author,
                'lines' => $this->tokenize($value->lines),
                'linecount' => $value->linecount,
                'service' => 'Poetry db'
            ];
        }
    }

    protected function tokenize(array $strings)
    {
        $normalize = array_map(function($el) {
            return explode("\n", $el) ?? '';
        }, $strings);

        $flatten = $this->flatten($normalize);

        return implode("\r\n", $flatten);
    }

    protected function flatten($items): array
    {
        if (!is_array($items)) {
            return [$items];
        }

        return array_reduce($items, function ($acc, $item) {
            return array_merge($acc, $this->flatten($item));
        }, []);
    }
}
