<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(){
        $roles = Role::all();
        
        return view('roles.index', compact('roles')); 
    }

    public function edit($id){
        $role = Role::findOrFail($id);
        $permissions = Permission::all();

        return view('roles.edit', compact('role', 'permissions'));

    }

    public function update(Request $request, $id){
        
        $role = Role::findOrFail($id);
        $role->permissions()->sync($request->permissions ?? []);

        return redirect('/roles')->with('success', 'Permission updated');
    }
}
