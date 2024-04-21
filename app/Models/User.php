<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,HasRoles;

    
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function tasksCreated()
    {
        return $this->hasMany(Task::class, 'created_by');
    }

    // public function tasksAssigned()
    // {
    //     return $this->hasMany(Task::class, 'assigned_to');
    // }
    public function tasks()
    {
        return $this->belongsToMany(Task::class);
    }
    public function comments():HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
