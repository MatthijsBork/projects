<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'deadline', 'state', 'project_id'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function state()
    {
        return $this->belongsTo(TaskState::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_tasks');
    }

    public static function getAllUsers()
    {
        return User::all();
    }

    public static function getAllStates()
    {
        return TaskState::all();
    }
}
