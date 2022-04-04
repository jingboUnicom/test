<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Location;
use Illuminate\Auth\Access\HandlesAuthorization;

class LocationPolicy
{
    use HandlesAuthorization;

    // Agents CANNOT BROWSE Locations
    // Employers CANNOT BROWSE Locations
    public function viewAny(User $user)
    {
        if ($user->agent) {
            return false;
        }

        if ($user->employer) {
            return false;
        }
    }

    // Agents CANNOT READ Locations
    // Employers CANNOT READ Locations
    public function view(User $user, Location $location)
    {
        if ($user->agent) {
            return false;
        }

        if ($user->employer) {
            return false;
        }
    }

    // Agents CANNOT ADD Locations
    // Employers CANNOT ADD Locations
    public function create(User $user)
    {
        if ($user->agent) {
            return false;
        }

        if ($user->employer) {
            return false;
        }
    }

    // Agents CANNOT EDIT Locations
    // Employers CANNOT EDIT Locations
    public function update(User $user, Location $location)
    {
        if ($user->agent) {
            return false;
        }

        if ($user->employer) {
            return false;
        }
    }

    // Agents CANNOT DELETE Locations
    // Employers CANNOT DELETE Locations
    public function delete(User $user, Location $location)
    {
        if ($user->agent) {
            return false;
        }

        if ($user->employer) {
            return false;
        }
    }

    // Agents CANNOT RESTORE Locations
    // Employers CANNOT RESTORE Locations
    public function restore(User $user, Location $location)
    {
        if ($user->agent) {
            return false;
        }

        if ($user->employer) {
            return false;
        }
    }

    // Agents CANNOT FORCE DELETE Locations
    // Employers CANNOT FORCE Delete Locations
    public function forceDelete(User $user, Location $location)
    {
        if ($user->agent) {
            return false;
        }

        if ($user->employer) {
            return false;
        }
    }
}
