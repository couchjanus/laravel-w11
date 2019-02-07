<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function __invoke()      
    {
        return view('about.index')->with('title', 'About Us Page');
    }
}
