<?php

namespace App\Policies;

use App\Models\Company;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CompanyPolicy
{
    use HandlesAuthorization;

    // Admins CAN BROWSE Companies
    // Agents CANNOT BROWSE Companies
    // Employers CAN BROWSE Companies
    // Guests CANNOT BROWSE Companies
    public function viewAny(User $user): bool
    {
        if ($user->super) {
            return true;
        }

        if ($user->agent) {
            return false;
        }

        if ($user->employer) {
            return true;
        }

        return false;
    }

    // Admins CAN READ Companies
    // Agents CANNOT READ Companies
    // Employers CAN READ Companies
    // Guests CANNOT READ Companies
    public function view(User $user, Company $company): bool
    {
        if ($user->super) {
            return true;
        }

        if ($user->agent) {
            return false;
        }

        if ($user->employer) {
            return true;
        }

        return false;
    }

    // Admins CAN ADD Companies
    // Agents CANNOT ADD Companies
    // Employers CANNOT ADD Companies
    // Guests CANNOT ADD Companies
    public function create(User $user): bool
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

    // Admins CAN EDIT Companies
    // Agents CANNOT EDIT Companies
    // Employers CAN EDIT Companies
    // Guests CANNOT EDIT Companies
    public function update(User $user, Company $company): bool
    {
        if ($user->super) {
            return true;
        }

        if ($user->agent) {
            return false;
        }

        if ($user->employer) {
            return true;
        }

        return false;
    }

    // Admins CAN DELETE Companies
    // Agents CANNOT DELETE Companies
    // Employers CANNOT DELETE Companies
    // Guests CANNOT DELETE Companies
    public function delete(User $user, Company $company): bool
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

    // Admins CAN RESTORE Companies
    // Agents CANNOT RESTORE Companies
    // Employers CANNOT RESTORE Companies
    // Guests CANNOT RESTORE Companies
    public function restore(User $user, Company $company): bool
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

    // Admins CAN FORCE DELETE Companies
    // Agents CANNOT FORCE DELETE Companies
    // Employers CANNOT FORCE DELETE Companies
    // Guests CANNOT FORCE DELETE Companies
    public function forceDelete(User $user, Company $company): bool
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
