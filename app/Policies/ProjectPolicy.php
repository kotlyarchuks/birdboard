<?php

namespace App\Policies;

use App\User;
use App\Project;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Project $project)
    {
        return $this->own($user, $project) or $project->members->contains($user);
    }

    public function own(User $user, Project $project)
    {
        return $user->is($project->owner);
    }
}
