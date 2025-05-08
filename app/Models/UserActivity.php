<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserActivity extends Model
{
    protected $fillable = [
        'user_id', 'activity_type', 'task_id', 'activity_details'
    ];

    public function task()
    {
        return $this->belongsTo(Task::class, 'task_id'); // Assuming 'task_id' is the foreign key in user_activities table
    }
}
