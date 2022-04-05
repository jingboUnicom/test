<?php

namespace App\Policies;

use App\Models\Company;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CompanyPolicy
{
    use HandlesAuthorization;

    // Agents CANNOT BROWSE Companies
    // Employers CAN BROWSE Companies
    public function viewAny(User $user): bool
    {
        if ($user->agent) {
            return false;
        }

        if ($user->employer) {
            return true;
        }
    }

    // Agents CANNOT READ Companies
    // Employers CAN READ Companies
    public function view(User $user, Company $company): bool
    {
        if ($user->agent) {
            return false;
        }

        if ($user->employer) {
            return true;
        }
    }

    // Agents CANNOT ADD Companies
    // Employers CANNOT ADD Companies
    public function create(User $user): bool
    {
        if ($user->agent) {
            return false;
        }

        if ($user->employer) {
            return false;
        }
    }

    // Agents CANNOT EDIT Companies
    // Employers CAN EDIT Companies
    public function update(User $user, Company $company): bool
    {
        if ($user->agent) {
            return false;
        }

        if ($user->employer) {
            return true;
        }
    }

    // Agents CANNOT DELETE Companies
    // Employers CANNOT DELETE Companies
    public function delete(User $user, Company $company): bool
    {
        if ($user->agent) {
            return false;
        }

        if ($user->employer) {
            return false;
        }
    }

    // Agents CANNOT RESTORE Companies
    // Employers CANNOT RESTORE Companies
    public function restore(User $user, Company $company): bool
    {
        if ($user->agent) {
            return false;
        }

        if ($user->employer) {
            return false;
        }
    }

    // Agents CANNOT FORCE DELETE Companies
    // Employers CANNOT FORCE DELETE Companies
    public function forceDelete(User $user, Company $company): bool
    {
        if ($user->agent) {
            return false;
        }

        if ($user->employer) {
            return false;
        }
    }
}
