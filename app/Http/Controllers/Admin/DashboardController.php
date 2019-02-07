<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()      
    {
        return view('admin.index')->with('title', 'Dashboard Page');
        // при помощи второго параметра хелпера
        // return view('admin.index', ['title' => 'Dashboard Page']);
        // $title = 'Dashboard Page';
        // return view('admin.index', compact('title'));
        // используя "магический" метод
        // return view('admin.index')->withTitle('Dashboard Page');
    }
}
