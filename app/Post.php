<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Builder;
use Cviebrock\EloquentSluggable\Sluggable;

use App\Scopes\TitleScope;
use App\Traits\HasComments;

class Post extends Model
{
    use Sluggable;
    use HasComments;
    
    protected $perPage = 10; 

    protected $dates = ['created_at', 'deleted_at']; 

    protected $fillable = [
        'title', 'content', 'status', 'category_id', 'user_id', 'visited'
    ];


    public $timestamps = true;

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new TitleScope);

        // \Route::bind('post', function ($value) {
        //     return Post::where('post', $value)->first() ?? abort(404);
        // });
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

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * Get all of the post's comments.
     */
    // public function comments()
    // {
    //     return $this->morphMany(Comment::class, 'commentable');
    // }

 
}
