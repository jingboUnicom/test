<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Interview;
use Illuminate\Auth\Access\HandlesAuthorization;

class InterviewPolicy
{
    use HandlesAuthorization;

    // Admins CAN BROWSE Interviews
    // Employers CAN BROWSE Interviews
    // Guests CANNOT BROWSE Interviews
    public function viewAny(User $user)
    {
        if ($user->super) {
            return true;
        }

        if ($user->employer) {
            return true;
        }

        return false;
    }

    // Admins CAN READ Interviews
    // Employers CAN READ Interviews
    // Guests CANNOT READ Interviews
    public function view(User $user, Interview $interview)
    {
        if ($user->super) {
            return true;
        }

        if ($user->employer) {
            return true;
        }

        return false;
    }

    // Admins CAN ADD Interviews
    // Employers CANNOT ADD Interviews
    // Guests CANNOT ADD Interviews
    public function create(User $user)
    {
        if ($user->super) {
            return true;
        }

        if ($user->employer) {
            return false;
        }

        return false;
    }

    // Admins CAN EDIT Interviews
    // Employers CANNOT EDIT Interviews
    // Guests CANNOT EDIT Interviews
    public function update(User $user, Interview $interview)
    {
        if ($user->super) {
            return true;
        }

        if ($user->employer) {
            return true;
        }

        return false;
    }

    // Admins CAN DELETE Interviews
    // Employers CANNOT DELETE Interviews
    // Guests CANNOT DELETE Interviews
    public function delete(User $user, Interview $interview)
    {
        if ($user->super) {
            return true;
        }

        if ($user->employer) {
            return false;
        }

        return false;
    }

    // Admins CAN RESTORE Interviews
    // Employers CANNOT RESTORE Interviews
    // Guests CANNOT RESTORE Interviews
    public function restore(User $user, Interview $interview)
    {
        if ($user->super) {
            return true;
        }


        if ($user->employer) {
            return false;
        }

        return false;
    }

    // Admins CAN FORCE DELETE Interviews
    // Employers CANNOT FORCE DELETE Interviews
    // Guests CANNOT FORCE DELETE Interviews
    public function forceDelete(User $user, Interview $interview)
    {
        if ($user->super) {
            return true;
        }

        if ($user->employer) {
            return false;
        }

        return false;
    }
}
