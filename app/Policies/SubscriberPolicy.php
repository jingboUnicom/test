<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Subscriber;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubscriberPolicy
{
    use HandlesAuthorization;

    // Admins CAN BROWSE Subscribers
    // Employers CANNOT BROWSE Subscribers
    // Guests CANNOT BROWSE Subscribers
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

    // Admins CAN READ Subscribers
    // Employers CANNOT READ Subscribers
    // Guests CANNOT READ Subscribers
    public function view(User $user, Subscriber $subscriber)
    {
        if ($user->super) {
            return true;
        }

        if ($user->employer) {
            return false;
        }

        return false;
    }

    // Admins CAN ADD Subscribers
    // Employers CANNOT ADD Subscribers
    // Guests CANNOT ADD Subscribers
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

    // Admins CAN EDIT Subscribers
    // Employers CANNOT EDIT Subscribers
    // Guests CANNOT EDIT Subscribers
    public function update(User $user, Subscriber $subscriber)
    {
        if ($user->super) {
            return true;
        }

        if ($user->employer) {
            return false;
        }

        return false;
    }

    // Admins CAN DELETE Subscribers
    // Employers CANNOT DELETE Subscribers
    // Guests CANNOT DELETE Subscribers
    public function delete(User $user, Subscriber $subscriber)
    {
        if ($user->super) {
            return true;
        }

        if ($user->employer) {
            return false;
        }

        return false;
    }

    // Admins CAN RESTORE Subscribers
    // Employers CANNOT RESTORE Subscribers
    // Guests CANNOT RESTORE Subscribers
    public function restore(User $user, Subscriber $subscriber)
    {
        if ($user->super) {
            return true;
        }

        if ($user->employer) {
            return false;
        }

        return false;
    }

    // Admins CAN FORCE DELETE Subscribers
    // Employers CANNOT FORCE DELETE Subscribers
    // Guests CANNOT FORCE DELETE Subscribers
    public function forceDelete(User $user, Subscriber $subscriber)
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
