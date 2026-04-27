<?php

namespace App\Providers;

use App\Models\User;
use App\Policies\UserPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);

        Gate::define('access-admin', function($user){
           return $user->hasRole('admin');
        });

        Gate::policy(User::class, UserPolicy::class);

        Gate::define('view-user', function($user){
            return $user->hasPermission('view-user');
        });
        
        Gate::define('edit-user', function($user){
            return $user->hasPermission('edit-user');
        });

        Gate::define('delete-user', function($user){
            return $user->hasPermission('delete-user');
        });

        Gate::define('manage-roles', function ($user){
            return $user->hasPermission('manage-roles');
        });

    }
}
