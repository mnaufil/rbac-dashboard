<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\UpdateUserRequest;


class UserController extends Controller
{
    public function index(){
        $users = User::all();
        return view('users.index', compact('users'));
        // return 'Controller Working';
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        // Policy check
        if (!Gate::allows('update', $user)) {
            abort(403);
        }

        $roles = Role::all();

        return view('users.edit', compact('user', 'roles'));
    }

    public function update(UpdateUserRequest  $request, $id){

        $user = User::findOrFail($id);

        if (!Gate::allows('update', $user)) {
            abort(403);
        }

        $validated = $request->validated();

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            ]);

        if(auth()->user()->hasRole('admin') && isset($validated['role'])){

            $currentUser = auth()->user();
            $isEditingSelf = $currentUser->id === $user->id;
            $isCurrentlyAdmin = $user->hasRole('admin');
            $newRole = Role::find($request->role);
            $isRemovingAdmin = $newRole->name !== 'admin';

            if ($isEditingSelf && $isCurrentlyAdmin && $isRemovingAdmin) {

                return redirect()->back()
                    ->with('error', 'You cannot remove your own admin role');
            }
            
            $user->roles()->sync([$request->role]);
        }

        return redirect('/users')->with('success', 'User updated successfully');
    }

    public function destroy($id){

        $user = User::findOrFail($id);

        if (!Gate::allows('delete', $user)) {
            abort(403);
        }

        $isAdmin = $user->hasRole('admin');

        $adminCount = User::wherehas('roles', function($query){
            $query->where('name', 'admin');
        })->count();

        if($isAdmin && $adminCount <= 1){
            return redirect('/users')
                ->with('error', 'At least one admin user must exist');
        }

        if ($user->id === auth()->id()) {
            return redirect('/users')->with('error', 'Admin cannot delete himself');
        }

        $user->delete();

        return redirect('/users')->with('success', 'User deleted successfully');
    }
}
