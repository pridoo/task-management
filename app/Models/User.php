<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $guard = 'web'; 
    protected $fillable = ['name', 'email', 'id_number', 'password'];

    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'task_user', 'task_id', 'user_id');
    }
    public function updates()
    {
        return $this->hasMany(TaskUpdate::class);
    }
}
