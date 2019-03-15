<?php namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Enums\StatusType;
use App\Entities\Article;
use Illuminate\Database\Eloquent\Collection;
use Config;

class ArticleRepository implements ArticleRepositoryInterface
{
    protected $post;

    public function __construct(Article $post)
    {
        $this->post = $post;
    }

    public function find($id)
    {
        return $this->post->find($id);
    }


    public function findBy($att, $column)
    {
        return $this->post->where($att, $column)->first();
    }

    public function paginate($perPage = 0, $columns = array('*'))
    {
        $perPage = $perPage ?: Config::get('laravel-article::pagination.length');
        return $this->post->paginate($perPage, $columns);
    }

    public function all($columns = array('*'))
    {
        return $this->post->all($columns);
    }
    
    // public function paginate($perPage = 0)
    // {
    //     $perPage = $perPage ?: Config::get('laravel-article::pagination.length');
    //     return $this->model->where('status', StatusType::Published)->paginate($perPage);
    // }

    
    
}