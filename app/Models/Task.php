<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;


class Task extends Model
{
    protected $fillable = [
        'title',
        'content',
        'start_date',
        'end_date',
        'priority',
        'status',
        'admin_id',
        'attachment',
        'picture'
    ];

    /**
     * Relationship with User model (many-to-many)
     */
    public function users()
    {

        return $this->belongsToMany(User::class, 'task_user', 'task_id', 'user_id');
        // Many-to-many relationship between tasks and users
        return $this->belongsToMany(User::class, 'task_user', 'task_id', 'user_id');
    }

    /**
     * Relationship with Admin model
     */
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    /**
     * Relationship with TaskUpdate model (one-to-many)
     */
    public function updates()
    {
        return $this->hasMany(TaskUpdate::class);
    }

    // siguraduhing may ganito sa taas ng file

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }


    

}
