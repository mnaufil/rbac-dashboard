<?php

namespace App\Http\Controllers;

use App\Models\User;
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

        return view('users.edit', compact('user'));
    }

    public function update(UpdateUserRequest  $request, $id){

        $user = User::findOrFail($id);

            // 🔐 Policy check
        if (!Gate::allows('update', $user)) {
            abort(403);
        }

        // 💾 Update
        $user->update($request->validated());

        return redirect('/users')->with('success', 'User updated successfully');
    }

    public function destroy($id){

        $user = User::findOrFail($id);

        // 🔐 Authorization (Gate → Policy)
        if (!Gate::allows('delete', $user)) {
            abort(403);
        }
        
        if ($user->id === auth()->id()) {
            return redirect('/users')->with('error', 'Admin cannot delete himself');
        }

        $user->delete();

        return redirect('/users')->with('success', 'User deleted successfully');
    }
}
