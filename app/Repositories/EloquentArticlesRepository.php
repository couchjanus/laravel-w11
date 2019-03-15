<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use App\Repositories\ElasticsearchArticleRepositoryInterface;
use App\Entities\Article;

class EloquentArticlesRepository implements ElasticsearchArticleRepositoryInterface
{
    public function search(string $query = ""): Collection
    {
        return Article::where('content', 'like', "%{$query}%")
            ->orWhere('title', 'like', "%{$query}%")
            ->get();
    }
}
