<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Builder;

use App\Enums\StatusType;
use App\Scopes\TitleScope;

class Post extends Model
{
    // Таблица, связанная с моделью. 
    protected $table = 'posts';

    // protected $primaryKey = 'uuid'; // Если у вас нету поля 'id'
    // public $incrementing = false; // Указывает что primary key не имеет свойства auto increment
   
    // переопределяем кол-во результатов на странице при пагинации (по-умолчанию: 15)
    protected $perPage = 25; 

    protected $dates = ['created_at', 'deleted_at']; // which fields will be Carbon-ized

    protected $fillable = [
        'title', 'content', 'status', 'category_id', 'user_id', 'visited'
    ];

    public $timestamps = true;

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
    
    // protected static function boot()
    // {
    //     parent::boot();
    //     static::addGlobalScope('title', function (Builder $builder) {
    //         $builder->orderBy('title', 'asc');
    //     });
    // }

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new TitleScope);
    }
         
}
