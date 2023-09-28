<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['description', 'deadline', 'state_id', 'project_id'];

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

}
