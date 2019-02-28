<?php

namespace App\Widgets;

use App\Widgets\Contracts\WidgetContract;
use App\Tag;

class TagsWidget implements WidgetContract
{
    public function execute()
    {
        $data = Tag::all();
        return $data;
    }

    // public function execute()
    // {
    //     $data = Tag::all();
    //     return view('widgets::categories', [
    //         'data' => $data
    //         ]
    //     );
    // }
}
