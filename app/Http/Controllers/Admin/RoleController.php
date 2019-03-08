<?php

namespace App\Http\Controllers\Admin;

use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::latest()->paginate(5);
        return view('admin.roles.index', compact('roles'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = \App\Permission::all();
        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role = Role::create($request->all());
        $role->permissions()->sync($request->permission, false);
        return redirect()->route('roles.index')->withType('success')->withMessage('Role created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $permissions = \App\Permission::all()->pluck('name', 'id');
        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $role->update($request->except('permission'));
        $role->permissions()->sync($request->input('permission'));
        return redirect()->route('roles.index')->withType('success')->withMessage('Role updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
       $role->delete();
       return redirect()->route('roles.index')->with('success','Role deleted successfully.');
    }

    /**
    * Delete all selected Role at once.
    */
//    public function massDestroy(Request $request)
//    {
//        if ($request->input('ids_to_delete')) {
//            $entries = Role::whereIn('id', $request->input('ids_to_delete'))->get();
//            foreach ($entries as $entry) {
//                $entry->delete();
//            }
//        }
//        return redirect()->route('roles.index')->with('success','Roles deleted successfully.');
//    }
}
