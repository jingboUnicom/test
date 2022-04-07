<?php

namespace App\Policies;

use App\Models\User;
use App\Models\State;
use Illuminate\Auth\Access\HandlesAuthorization;

class StatePolicy
{
    use HandlesAuthorization;

    // Admins CAN BROWSE States
    // Agents CANNOT BROWSE States
    // Employers CANNOT BROWSE States
    // Guests CANNOT BROWSE States
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

    // Admins CAN READ States
    // Agents CANNOT READ States
    // Employers CANNOT READ States
    // Guests CANNOT READ States
    public function view(User $user, State $state)
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

    // Admins CAN ADD States
    // Agents CANNOT ADD States
    // Employers CANNOT ADD States
    // Guests CANNOT ADD States
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

    // Admins CAN EDIT States
    // Agents CANNOT EDIT States
    // Employers CANNOT EDIT States
    // Guests CANNOT EDIT States
    public function update(User $user, State $state)
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

    // Admins CAN DELETE States
    // Agents CANNOT DELETE States
    // Employers CANNOT DELETE States
    // Guests CANNOT DELETE States
    public function delete(User $user, State $state)
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

    // Admins CAN RESTORE States
    // Agents CANNOT RESTORE States
    // Employers CANNOT RESTORE States
    // Guests CANNOT RESTORE States
    public function restore(User $user, State $state)
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

    // Admins CAN FORCE DELETE States
    // Agents CANNOT FORCE DELETE States
    // Employers CANNOT FORCE Delete States
    // Guests CANNOT FORCE Delete States
    public function forceDelete(User $user, State $state)
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
