<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Work;
use Illuminate\Auth\Access\HandlesAuthorization;

class WorkPolicy
{
    use HandlesAuthorization;

    // Admins CAN BROWSE Works
    // Agents CANNOT BROWSE Works
    // Employers CANNOT BROWSE Works
    // Guests CANNOT BROWSE Works
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

    // Admins CAN READ Works
    // Agents CANNOT READ Works
    // Employers CANNOT READ Works
    // Guests CANNOT READ Works
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

    // Admins CAN ADD Works
    // Agents CANNOT ADD Works
    // Employers CANNOT ADD Works
    // Guests CANNOT ADD Works
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

    // Admins CAN EDIT Works
    // Agents CANNOT EDIT Works
    // Employers CANNOT EDIT Works
    // Guests CANNOT EDIT Works
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

    // Admins CAN DELETE Works
    // Agents CANNOT DELETE Works
    // Employers CANNOT DELETE Works
    // Guests CANNOT DELETE Works
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

    // Admins CAN RESTORE Works
    // Agents CANNOT RESTORE Works
    // Employers CANNOT RESTORE Works
    // Guests CANNOT RESTORE Works
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

    // Admins CAN FORCE DELETE Works
    // Agents CANNOT FORCE DELETE Works
    // Employers CANNOT FORCE Delete Works
    // Guests CANNOT FORCE Delete Works
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
