<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // Таблица, связана с моделью.
    protected $table = 'categories';
    
    // А этими константами можно переопределить название полей для created_at и updated_at
    const CREATED_AT = 'created_at'; 
    const UPDATED_AT = 'updated_at'; 

    // Определяет необходимость отметок времени для модели.    
    public $timestamps = true;

    
    // или можно указать что мы вообще не используем поля created_at и updated_at
    // public $timestamps = false; 

    // Формат хранения отметок времени модели.    
    // public $dateFormat = 'U';
    
    // Для настройки формата времени перекройте метод getDateFormat():
    // public function getDateFormat()
    // {
    //     return 'U';
    // }
    
    // Можно использовать другой способ обновить значение
    // timestamps created_at и updated_at:
    // public function setUpdatedAt($value)
    // {
    //     return null;
    // }
    
    // public function setCreatedAt($value)
    // {
    //     return null;
    // }

    protected $fillable = [
        'name', 'description',
    ];

    protected $dates = ['created_at', 'deleted_at']; // which fields will be Carbon-ized

}
