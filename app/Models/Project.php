<?php

namespace App\Models;

use App\Models\ProjectUserRole;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'start_date', 'image_name'];

    public function ProjectUserRoles()
    {
        return $this->hasMany(ProjectUserRole::class);
    }
}
