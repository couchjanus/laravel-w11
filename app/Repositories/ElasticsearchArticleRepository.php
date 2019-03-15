<?php

namespace App\Repositories;

use App\Entities\Article;
use Elasticsearch\Client;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\ElasticsearchArticleRepositoryInterface;

class ElasticsearchArticleRepository implements ElasticsearchArticleRepositoryInterface
{
    private $search;

    public function __construct(Client $client) {
        $this->search = $client;
    }

    public function search(string $query = ""): Collection
    {
        $items = $this->searchOnElasticsearch($query);

        return $this->buildCollection($items);
    }

    private function searchOnElasticsearch(string $query): array
    {
    	$instance = new Article;

        $items = $this->search->search([
            'index' => $instance->getSearchIndex(),
            'type' => $instance->getSearchType(),
            'body' => [
                'query' => [
                    'multi_match' => [
                    	'fields' => ['title', 'content'],
                        'query' => $query,
                    ],
                ],
            ],
        ]);

        return $items;
    }

    private function buildCollection(array $items): Collection
    {
        
        $hits = array_pluck($items['hits']['hits'], '_source') ?: [];
        
        $sources = array_map(function ($source) {
            // $source['tags'] = json_encode($source['tags']);
            return $source;
        }, $hits);

        return Article::hydrate($sources);
    }
}
