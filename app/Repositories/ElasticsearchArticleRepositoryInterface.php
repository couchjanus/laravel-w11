<?php namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface ElasticsearchArticleRepositoryInterface
{
    
    public function search(string $query = ""): Collection;
}