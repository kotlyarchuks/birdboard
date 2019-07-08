<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvitationRequest;
use App\Project;
use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class InvitationsController extends Controller
{

    public function store(Project $project, InvitationRequest $request)
    {
        $validated = $request->validated();

        $userToInvite = User::whereEmail($validated['email'])->first();
        $project->invite($userToInvite);

        return redirect($project->path());
    }
}
