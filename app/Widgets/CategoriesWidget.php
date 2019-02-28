<?php

namespace App\Widgets;

use App\Widgets\Contracts\WidgetContract;
use App\Category;

class CategoriesWidget implements WidgetContract
{
    // public function execute()
    // {
    //     $data = Category::all();
    //     return $data;
    // }

    public function execute()
    {
        $data = Category::all();
        return view('widgets::categories', [
            'data' => $data
            ]
        );
    }
}
