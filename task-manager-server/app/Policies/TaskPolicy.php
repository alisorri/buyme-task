<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
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

    public function destroy(User $user, Task $task)
    {
        dd($user->id);
        return $user->id === $task->user->id;
    }
}
