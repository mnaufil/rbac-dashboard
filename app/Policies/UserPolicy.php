<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
   
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('view-user');
    }

    public function view(User $user, User $model): bool
    {
        return false;
    }

    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user, User $model): bool
    {
       
        if($user->hasPermission('edit-user')){
            return true;
        }

        return $user->id === $model->id;

    }

    public function delete(User $user, User $model): bool
    {
       return $user->hasPermission('delete-user');
    }

    public function restore(User $user, User $model): bool
    {
        return false;
    }

    public function forceDelete(User $user, User $model): bool
    {
        return false;
    }
}
