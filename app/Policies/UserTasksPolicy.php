<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Project;
use App\Models\UserTask;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserTasksPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function hasTask(User $user, $task)
    {
        return UserTask::where('user_id', $user->id)
        ->where('task_id', $task->id)
        ->exists();
    }
}
