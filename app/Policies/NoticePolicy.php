<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Notice;
use Illuminate\Auth\Access\HandlesAuthorization;

class NoticePolicy
{
    use HandlesAuthorization;

    // Agents CANNOT BROWSE Notices
    // Employers CANNOT BROWSE Notices
    public function viewAny(User $user)
    {
        if ($user->agent) {
            return false;
        }

        if ($user->employer) {
            return false;
        }
    }

    // Agents CANNOT READ Notices
    // Employers CANNOT READ Notices
    public function view(User $user, Notice $notice)
    {
        if ($user->agent) {
            return false;
        }

        if ($user->employer) {
            return false;
        }
    }

    // Agents CANNOT ADD Notices
    // Employers CANNOT ADD Notices
    public function create(User $user)
    {
        if ($user->agent) {
            return false;
        }

        if ($user->employer) {
            return false;
        }
    }

    // Agents CANNOT EDIT Notices
    // Employers CANNOT EDIT Notices
    public function update(User $user, Notice $notice)
    {
        if ($user->agent) {
            return false;
        }

        if ($user->employer) {
            return false;
        }
    }

    // Agents CANNOT DELETE Notices
    // Employers CANNOT DELETE Notices
    public function delete(User $user, Notice $notice)
    {
        if ($user->agent) {
            return false;
        }

        if ($user->employer) {
            return false;
        }
    }

    // Agents CANNOT RESTORE Notices
    // Employers CANNOT RESTORE Notices
    public function restore(User $user, Notice $notice)
    {
        if ($user->agent) {
            return false;
        }

        if ($user->employer) {
            return false;
        }
    }

    // Agents CANNOT FORCE DELETE Notices
    // Employers CANNOT FORCE DELETE Notices
    public function forceDelete(User $user, Notice $notice)
    {
        if ($user->agent) {
            return false;
        }

        if ($user->employer) {
            return false;
        }
    }
}
