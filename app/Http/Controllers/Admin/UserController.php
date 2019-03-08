<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreFormRequest;

use Hash;
use App\Role;

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

        return redirect(route('users.trashed'))->withType('success')->withMessage('User has been restored successfully!');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create')->withRoles($roles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreFormRequest $request)
    {
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        $profile = new Profile();
        $user->profile()->save($profile);

        // $user->syncRoles($request->role);
        $user->roles()->sync($request->role, false);

        return redirect()->route('users.index')->withType('success')->withMessage('User has been added successfully!');
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
        $roles = Role::get()->pluck('name', 'id');
        return view('admin.users.edit')->withUser($user)->withRoles($roles);

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
        $user->update(['name' => $request->name]);
        $user->roles()->sync((array)$request->input('role'));
        // $user->syncRoles((array)$request->input('role'));
        return redirect(route('users.index'))->with('type','success')->with('message','User has been updated successfully!');
  
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
            ->withType('success')->withMessage('User moved to tresh successfully!');
    }

    public function userDestroy($id)
    {
        User::trash($id)->forceDelete();
        return redirect()->route('users.index')
            ->withType('success')->withMessage('User deleted from tresh successfully!');
    }
}
