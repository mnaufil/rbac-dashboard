<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use GrahamCampbell\ResultType\Success;
use App\Models\ActivityLog;
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

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'create-role',
            'description' => auth()->user()->name .
                ' created role ' .
                $role->name
        ]);

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
        $oldRoleName = $role->name;
        $role->permissions()->sync($request->permissions ?? []);

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'update-role-permissions',
            'description' => auth()->user()->name .
                ' updated permissions for role ' .
                $role->name
        ]);
        
        if ($oldRoleName !== $role->name) {

            ActivityLog::create([
                'user_id' => auth()->id(),
                'action' => 'update-role',
                'description' => auth()->user()->name .
                    ' renamed role ' .
                    $oldRoleName .
                    ' to ' .
                    $role->name
            ]);
        }

        return redirect('/roles')->with('success', 'Permission updated');
    }
    
    public function destroy($id){
        $role = Role::findOrFail($id);
        $protectedRole = ['admin', 'super-admin'];

        if(in_array($role->name, $protectedRole)){
            return redirect('/roles')
                ->with('error', 'This role is protected and cannot be deleted');
        }


        // Check if role has users
        if ($role->users()->count() > 0) {

            return redirect('/roles')
                ->with('error', 'Role is assigned to users and cannot be deleted');
        }

        $roleName = $role->name;
        $role->delete();

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'delete-role',
            'description' => auth()->user()->name .
                ' deleted role ' .
                $roleName
        ]);


        return redirect('/roles')
            ->with('success', 'Role deleted successfully');
    }

    
}
