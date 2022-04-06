<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Subscriber;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubscriberPolicy
{
    use HandlesAuthorization;

    // Agents CANNOT BROWSE Subscribers
    // Employers CANNOT BROWSE Subscribers
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

    // Agents CANNOT READ Subscribers
    // Employers CANNOT READ Subscribers
    public function view(User $user, Subscriber $subscriber)
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

    // Agents CANNOT ADD Subscribers
    // Employers CANNOT ADD Subscribers
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

    // Agents CANNOT EDIT Subscribers
    // Employers CANNOT EDIT Subscribers
    public function update(User $user, Subscriber $subscriber)
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

    // Agents CANNOT DELETE Subscribers
    // Employers CANNOT DELETE Subscribers
    public function delete(User $user, Subscriber $subscriber)
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

    // Agents CANNOT RESTORE Subscribers
    // Employers CANNOT RESTORE Subscribers
    public function restore(User $user, Subscriber $subscriber)
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

    // Agents CANNOT FORCE DELETE Subscribers
    // Employers CANNOT FORCE DELETE Subscribers
    public function forceDelete(User $user, Subscriber $subscriber)
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
