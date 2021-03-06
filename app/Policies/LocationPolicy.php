<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Location;
use Illuminate\Auth\Access\HandlesAuthorization;

class LocationPolicy
{
    use HandlesAuthorization;

    // Admins CAN BROWSE Locations
    // Employers CANNOT BROWSE Locations
    // Guests CANNOT BROWSE Locations
    public function viewAny(User $user)
    {
        if ($user->super) {
            return true;
        }

        if ($user->employer) {
            return false;
        }

        return false;
    }

    // Admins CAN READ Locations
    // Employers CANNOT READ Locations
    // Guests CANNOT READ Locations
    public function view(User $user, Location $location)
    {
        if ($user->super) {
            return true;
        }

        if ($user->employer) {
            return false;
        }

        return false;
    }

    // Admins CAN ADD Locations
    // Employers CANNOT ADD Locations
    // Guests CANNOT ADD Locations
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

    // Admins CAN EDIT Locations
    // Employers CANNOT EDIT Locations
    // Guests CANNOT EDIT Locations
    public function update(User $user, Location $location)
    {
        if ($user->super) {
            return true;
        }

        if ($user->employer) {
            return false;
        }

        return false;
    }

    // Admins CAN DELETE Locations
    // Employers CANNOT DELETE Locations
    // Guets CANNOT DELETE Locations
    public function delete(User $user, Location $location)
    {
        if ($user->super) {
            return true;
        }

        if ($user->employer) {
            return false;
        }

        return false;
    }

    // Admins CAN RESTORE Locations
    // Employers CANNOT RESTORE Locations
    // Guests CANNOT RESTORE Locations
    public function restore(User $user, Location $location)
    {
        if ($user->super) {
            return true;
        }

        if ($user->employer) {
            return false;
        }

        return false;
    }

    // Admins CAN FORCE DELETE Locations
    // Employers CANNOT FORCE DELETE Locations
    // Guests CANNOT FORCE DELETE Locations
    public function forceDelete(User $user, Location $location)
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
