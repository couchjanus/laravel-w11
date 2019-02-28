<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreFormRequest;

use Hash;

use App\Profile;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate();
        // dump($users);
        return view('admin.users.index', ['users' => $users]);
    }

    public function trashed()
    {
        $users = User::onlyTrashed()->paginate(env('LIST_PAGINATION_SIZE'));
        return view('admin.users.trashed', compact('users'));
    }

    public function restore($id)
    {
        User::withTrashed()
            ->where('id', $id)
            ->restore();

        return redirect(route('users.trashed'))->with('success', 'User has been restored successfully');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(UserStoreFormRequest $request)
    // {
    //     User::create([
    //         'name' => $request['name'],
    //         'email' => $request['email'],
    //         'password' => Hash::make($request['password']),
    //     ]);
    //     session()->flash('message', 'User has been added successfully!');
    //     session()->flash('type', 'success');
    //     return redirect()->route('users.index');
    // }

    public function store(UserStoreFormRequest $request)
    {
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        $profile = new Profile();
        $user->profile()->save($profile);
 
        session()->flash('message', 'User has been added successfully!');
        session()->flash('type', 'success');
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')
                ->with('success','User deleted successfully');
    }

    // public function userDestroy($id)
    // {
    //     $user = User::withTrashed()
    //             ->findOrFail($id);
    //     // dd($user);
    //     $user->forceDelete();
    //     return redirect()->route('users.index')
    //             ->with('success','User deleted successfully');

    // }

    public function userDestroy($id)
    {
        User::trash($id)->forceDelete();
        return redirect()->route('users.index')
                ->with('success','User deleted from tresh successfully');
    }
}
