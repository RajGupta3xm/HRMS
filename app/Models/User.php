<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'employee_Id',
        'name',
        'email',
        'userDepartment',
        'userDesignation',
        'password',
        'role_id',
        'status'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function userDepartment(): Attribute
    {
        return new Attribute(
            get: fn ($value) =>  ["Delivery", "Marketing", "Admin", "HR", "Business","Business Admin"][$value],
        );
    }

    public function roles()
    {
        return  $this->belongsToMany(Role::class, 'user_roles');
    }

    public function hasRole($role)
    {
        return $this->roles->contains('name', $role);
    }

    public function projects()
    {
        return $this->belongsToMany(AddProjects::class, 'projects', 'user_id', 'project_id')->withPivot('allocation');
    }

    public function addworkesEmployees()
    {
        return $this->hasMany(AddworkesEmployee::class, 'userId', 'userId');
    }

    public function project()
    {
        return $this->belongsTo(AddProjects::class, 'project_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'project_id', 'project_id');
    }
    public function isProjectManager()
    {
        return $this->userDesignation === 'Project Manager'; // Adjust this condition based on your implementation
    }


}
