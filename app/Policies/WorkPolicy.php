<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Work;
use Illuminate\Auth\Access\HandlesAuthorization;

class WorkPolicy
{
    use HandlesAuthorization;

    // Agents CANNOT BROWSE Works
    // Employers CANNOT BROWSE Works
    public function viewAny(User $user)
    {
        if ($user->super) {
            return true;
        }

        if ($user->agent) {
            return false;
        }

        if ($user->employer) {
            return false;
        }

        return false;
    }

    // Agents CANNOT READ Works
    // Employers CANNOT READ Works
    public function view(User $user, Work $work)
    {
        if ($user->super) {
            return true;
        }

        if ($user->agent) {
            return false;
        }

        if ($user->employer) {
            return false;
        }

        return false;
    }

    // Agents CANNOT ADD Works
    // Employers CANNOT ADD Works
    public function create(User $user)
    {
        if ($user->super) {
            return true;
        }

        if ($user->agent) {
            return false;
        }

        if ($user->employer) {
            return false;
        }

        return false;
    }

    // Agents CANNOT EDIT Works
    // Employers CANNOT EDIT Works
    public function update(User $user, Work $work)
    {
        if ($user->super) {
            return true;
        }

        if ($user->agent) {
            return false;
        }

        if ($user->employer) {
            return false;
        }

        return false;
    }

    // Agents CANNOT DELETE Works
    // Employers CANNOT DELETE Works
    public function delete(User $user, Work $work)
    {
        if ($user->super) {
            return true;
        }

        if ($user->agent) {
            return false;
        }

        if ($user->employer) {
            return false;
        }

        return false;
    }

    // Agents CANNOT RESTORE Works
    // Employers CANNOT RESTORE Works
    public function restore(User $user, Work $work)
    {
        if ($user->super) {
            return true;
        }

        if ($user->agent) {
            return false;
        }

        if ($user->employer) {
            return false;
        }

        return false;
    }

    // Agents CANNOT FORCE DELETE Works
    // Employers CANNOT FORCE Delete Works
    public function forceDelete(User $user, Work $work)
    {
        if ($user->super) {
            return true;
        }

        if ($user->agent) {
            return false;
        }

        if ($user->employer) {
            return false;
        }

        return false;
    }
}
