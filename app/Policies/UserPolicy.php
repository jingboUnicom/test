<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    // Admins CAN BROWSE Users
    // Employers CAN BROWSE Users
    // Guests CANNOT BROWSE Users
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

    // Admins CAN READ Users
    // Employers CAN READ Users
    // Guests CANNOT READ Users
    public function view(User $user, User $model)
    {
        if ($user->super) {
            return true;
        }

        if ($user->employer) {
            return true;
        }

        return false;
    }

    // Admins CAN ADD Users
    // Employers CANNOT ADD Users
    // Guests CANNOT ADD Users
    public function create(User $user)
    {
        if ($user->super) {
            return true;
        }

        if ($user->employer) {
            return true;
        }

        return false;
    }

    // Admins CAN EDIT Users
    // Employers CAN EDIT Users
    // Guests CANNOT EDIT Users
    public function update(User $user, User $model)
    {
        if ($user->super) {
            return true;
        }

        if ($user->employer) {
            return true;
        }

        return false;
    }

    // Admins CAN DELETE Users
    // Employers CANNOT DELETE Users
    // Guests CANNOT DELETE Users
    public function delete(User $user, User $model)
    {
        if ($user->super) {
            return true;
        }

        if ($user->employer) {
            return true;
        }

        return false;
    }

    // Admins CAN RESTORE Users
    // Employers CANNOT RESTORE Users
    // Guests CANNOT RESTORE Users
    public function restore(User $user, User $model)
    {
        if ($user->super) {
            return true;
        }

        if ($user->employer) {
            return false;
        }

        return false;
    }

    // Admins CAN FORCE DELETE Users
    // Employers CANNOT FORCE DELETE Users
    // Guests CANNOT FORCE DELETE Users
    public function forceDelete(User $user, User $model)
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
