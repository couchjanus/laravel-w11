<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Builder;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use Sluggable;
    
    protected $perPage = 10; 

    protected $dates = ['created_at', 'deleted_at']; 

    protected $fillable = [
        'title', 'content', 'status', 'category_id', 'user_id'
    ];

    public $timestamps = true;

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('title', function (Builder $builder) {
            $builder->orderBy('title', 'asc');
        });

        // \Route::bind('post', function ($value) {
        //     return Post::where('post', $value)->first() ?? abort(404);
        // });
    }

    /**
     * Retrieve the model for a bound value.
     *
     * @param  mixed  $value
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function resolveRouteBinding($value)
    {
        return $this->where('slug', $value)->first() ?? abort(404);
    }

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

    /**
     * 
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
 
}
