<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'title', 'content', 'start_date', 'end_date',
        'priority', 'status', 'assigned_to', 'admin_id',
        'attachment', 'picture'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function updates()
    {
        return $this->hasMany(TaskUpdate::class);
    }
}
