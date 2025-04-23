<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $guard = 'admin'; 

    protected $fillable = ['name', 'email', 'id_number', 'password'];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}