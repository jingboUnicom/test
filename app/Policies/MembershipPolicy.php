<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Membership;
use Illuminate\Auth\Access\HandlesAuthorization;

class MembershipPolicy
{
    use HandlesAuthorization;

    // Admins CAN BROWSE Memberships
    // Agents CANNOT BROWSE Memberships
    // Employers CANNOT BROWSE Memberships
    // Guests CANNOT BROWSE Memberships
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

    // Admins CAN READ Memberships
    // Agents CANNOT READ Memberships
    // Employers CANNOT READ Memberships
    // Guests CANNOT READ Memberships
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

    // Admins CAN ADD Memberships
    // Agents CANNOT ADD Memberships
    // Employers CANNOT ADD Memberships
    // Guests CANNOT ADD Memberships
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

    // Admins CAN EDIT Memberships
    // Agents CANNOT EDIT Memberships
    // Employers CANNOT EDIT Memberships
    // Guests CANNOT EDIT Memberships
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

    // Admins CAN DELETE Memberships
    // Agents CANNOT DELETE Memberships
    // Employers CANNOT DELETE Memberships
    // Guests CANNOT DELETE Memberships
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

    // Admins CAN RESTORE Memberships
    // Agents CANNOT RESTORE Memberships
    // Employers CANNOT RESTORE Memberships
    // Guests CANNOT RESTORE Memberships
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

    // Admins CAN FORCE DELETE Memberships
    // Agents CANNOT FORCE DELETE Memberships
    // Employers CANNOT FORCE Delete Memberships
    // Guests CANNOT FORCE Delete Memberships
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
