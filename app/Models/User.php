<?php

namespace App\Models;

use App\Models\Role;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    public function hasRole($role){
        // return $this->roles->contains('name', $role);
        return $this->roles()->where('name', $role)->exists();
    }

    public function hasPermission($permission){
        return $this->roles
                ->flatmap->permission
                ->contains('name', $permission);
    }
    
}
