<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Tag extends Model
{
    use Sluggable;
    
    /**
    * Return the sluggable configuration array for this model.
    *
    * @return array
    */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    
    protected $fillable = [
        'name'
    ];

    protected $touches = ['posts'];

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
