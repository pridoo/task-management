<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['task_id', 'user_id', 'content'];

    // Relationship to Task
    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    // Relationship to User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'user_id');
    }
}