<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Membership;
use Illuminate\Auth\Access\HandlesAuthorization;

class MembershipPolicy
{
    use HandlesAuthorization;

    // Agents CANNOT BROWSE Memberships
    // Employers CANNOT BROWSE Memberships
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

    // Agents CANNOT READ Memberships
    // Employers CANNOT READ Memberships
    public function view(User $user, Membership $membership)
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

    // Agents CANNOT ADD Memberships
    // Employers CANNOT ADD Memberships
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

    // Agents CANNOT EDIT Memberships
    // Employers CANNOT EDIT Memberships
    public function update(User $user, Membership $membership)
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

    // Agents CANNOT DELETE Memberships
    // Employers CANNOT DELETE Memberships
    public function delete(User $user, Membership $membership)
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

    // Agents CANNOT RESTORE Memberships
    // Employers CANNOT RESTORE Memberships
    public function restore(User $user, Membership $membership)
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

    // Agents CANNOT FORCE DELETE Memberships
    // Employers CANNOT FORCE Delete Memberships
    public function forceDelete(User $user, Membership $membership)
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
