<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    // Define the fillable fields
    protected $fillable = ['user_id', 'message', 'is_read', 'task_title'];

    // Set the default value for 'is_read' when creating a new notification
    protected $attributes = [
        'is_read' => false, // Default value for is_read
    ];
}
