<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    // Agents CAN BROWSE Users
    // Employers CAN BROWSE Users
    public function viewAny(User $user)
    {
        if ($user->agent) {
            return true;
        }

        if ($user->employer) {
            return true;
        }
    }

    // Agents CAN READ Users
    // Employers CAN READ Users
    public function view(User $user, User $model)
    {
        if ($user->agent) {
            return true;
        }

        if ($user->employer) {
            return true;
        }
    }

    // Agents CANNOT ADD Users
    // Employers CANNOT ADD Users
    public function create(User $user)
    {
        if ($user->agent) {
            return false;
        }

        if ($user->employer) {
            return false;
        }
    }

    // Agents CAN EDIT Users
    // Employers CAN EDIT Users
    public function update(User $user, User $model)
    {
        if ($user->agent) {
            return true;
        }

        if ($user->employer) {
            return true;
        }
    }

    // Agents CANNOT DELETE Users
    // Employers CANNOT DELETE Users
    public function delete(User $user, User $model)
    {
        if ($user->agent) {
            return false;
        }

        if ($user->employer) {
            return false;
        }
    }

    // Agents CANNOT RESTORE Users
    // Employers CANNOT RESTORE Users
    public function restore(User $user, User $model)
    {
        if ($user->agent) {
            return false;
        }

        if ($user->employer) {
            return false;
        }
    }

    // Agents CANNOT FORCE DELETE Users
    // Employers CANNOT FORCE DELETE Users
    public function forceDelete(User $user, User $model)
    {
        if ($user->agent) {
            return false;
        }

        if ($user->employer) {
            return false;
        }
    }
}
