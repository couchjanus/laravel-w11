<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

use App\Traits\HasPermission;

class Role extends Model
{
    use Sluggable;
    use HasPermission;

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
        'name',
    ];
    
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
