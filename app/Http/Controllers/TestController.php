<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Illuminate\Support\Facades\Gate;

class TestController extends Controller
{
        
    public function index()
    {
        // $permissions = \App\Permission::all();
        // dump($permissions);

        // $user = User::where('id', 1)->with('roles')->firstOrFail();
        
        $user = \Auth::user();
        dump($user->roles);
        
        dump($user->can('can-list'));
      
            
    }
}
