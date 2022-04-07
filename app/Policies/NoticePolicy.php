<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Notice;
use Illuminate\Auth\Access\HandlesAuthorization;

class NoticePolicy
{
    use HandlesAuthorization;

    // Admins CAN BROWSE Notices
    // Employers CANNOT BROWSE Notices
    // Guests CANNOT BROWSE Notices
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

    // Admins CAN READ Notices
    // Employers CANNOT READ Notices
    // Guests CANNOT READ Notices
    public function view(User $user, Notice $notice)
    {
        if ($user->super) {
            return true;
        }

        if ($user->employer) {
            return false;
        }

        return false;
    }

    // Admins CAN ADD Notices
    // Employers CANNOT ADD Notices
    // Guests CANNOT ADD Notices
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

    // Admins CAN EDIT Notices
    // Employers CANNOT EDIT Notices
    // Guests CANNOT EDIT Notices
    public function update(User $user, Notice $notice)
    {
        if ($user->super) {
            return true;
        }

        if ($user->employer) {
            return false;
        }

        return false;
    }

    // Admins CAN DELETE Notices
    // Employers CANNOT DELETE Notices
    // Guests CANNOT DELETE Notices
    public function delete(User $user, Notice $notice)
    {
        if ($user->super) {
            return true;
        }

        if ($user->employer) {
            return false;
        }

        return false;
    }

    // Admins CAN RESTORE Notices
    // Employers CANNOT RESTORE Notices
    // Guests CANNOT RESTORE Notices
    public function restore(User $user, Notice $notice)
    {
        if ($user->super) {
            return true;
        }

        if ($user->employer) {
            return false;
        }

        return false;
    }

    // Admins CAN FORCE DELETE Notices
    // Employers CANNOT FORCE DELETE Notices
    // Guests CANNOT FORCE DELETE Notices
    public function forceDelete(User $user, Notice $notice)
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
