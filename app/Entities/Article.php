<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Traits\Search\Searchable;
use App\Scopes\TitleScope;

/**
 * Class Article.
 *
 * @package namespace App\Entities;
 */
class Article extends Model
{
    use Sluggable;
    use Searchable;

    protected $table = 'posts';
    
    protected $perPage = 10; 

    protected $dates = ['created_at', 'deleted_at']; 
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'content', 'status', 'category_id', 'user_id', 'visited'
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * Scope a query to only include posts of a given type.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  mixed $type
     * @return \Illuminate\Database\Eloquent\Builder
     */

    static function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }



}
