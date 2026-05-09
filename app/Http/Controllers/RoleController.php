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
   
    public function create(){
        
        $permissions = Permission::all();

        return view('roles.create', compact('permissions')); 
    }

    public function store(Request $request){
        
          $request->validate([
        'name' => 'required|min:4',
        ], [
            'name.required' => 'Role name is required.',
            'name.min' => 'Role name must be at least 4 characters.',
        ]);

        $role = Role::create([
            'name' => $request->name
        ]);

        $role->permissions()->sync($request->permissions ?? []);

        return redirect('/roles')->with('success', 'Role created successfully');
    }

    public function edit($id){
        $role = Role::findOrFail($id);
        $permissions = Permission::all();

        return view('roles.edit', compact('role', 'permissions'));

    }

    public function update(Request $request, $id){
        
        $request->validate([
            'name' => 'required|min:4',
        ], [
            'name.required' => 'Role name is required.',
            'name.min' => 'Role name must be at least 4 characters.',
        ]);

        $role = Role::findOrFail($id);
        $role->permissions()->sync($request->permissions ?? []);

        return redirect('/roles')->with('success', 'Permission updated');
    }

    
}
