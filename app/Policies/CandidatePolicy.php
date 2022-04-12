<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Candidate;
use Illuminate\Auth\Access\HandlesAuthorization;

class CandidatePolicy
{
    use HandlesAuthorization;

    // Admins CAN BROWSE Candidates
    // Employers CAN BROWSE Candidates
    // Guests CANNOT BROWSE Candidates
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

    // Admins CAN READ Candidates
    // Employers CAN READ Candidates
    // Guests CANNOT READ Candidates
    public function view(User $user, Candidate $candidate)
    {
        if ($user->super) {
            return true;
        }

        if ($user->employer) {
            return true;
        }

        return false;
    }

    // Admins CAN ADD Candidates
    // Employers CANNOT ADD Candidates
    // Guests CANNOT ADD Candidates
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

    // Admins CAN EDIT Candidates
    // Employers CANNOT EDIT Candidates
    // Guests CANNOT EDIT Candidates
    public function update(User $user, Candidate $candidate)
    {
        if ($user->super) {
            return true;
        }

        if ($user->employer) {
            return false;
        }

        return false;
    }

    // Admins CAN DELETE Candidates
    // Employers CANNOT DELETE Candidates
    // Guests CANNOT DELETE Candidates
    public function delete(User $user, Candidate $candidate)
    {
        if ($user->super) {
            return true;
        }

        if ($user->employer) {
            return false;
        }

        return false;
    }

    // Admins CAN RESTORE Candidates
    // Employers CANNOT RESTORE Candidates
    // Guests CANNOT RESTORE Candidates
    public function restore(User $user, Candidate $candidate)
    {
        if ($user->super) {
            return true;
        }


        if ($user->employer) {
            return false;
        }

        return false;
    }

    // Admins CAN FORCE DELETE Candidates
    // Employers CANNOT FORCE DELETE Candidates
    // Guests CANNOT FORCE DELETE Candidates
    public function forceDelete(User $user, Candidate $candidate)
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
