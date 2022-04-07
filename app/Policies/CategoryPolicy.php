<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Category;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

    // Admins CAN BROWSE Categories
    // Agents CANNOT BROWSE Categories
    // Employers CANNOT BROWSE Categories
    // Guests CANNOT BROWSE Categories
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

    // Admins CAN READ Categories
    // Agents CANNOT READ Categories
    // Employers CANNOT READ Categories
    // Guests CANNOT READ Categories
    public function view(User $user, Category $category)
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

    // Admins CAN ADD Categories
    // Agents CANNOT ADD Categories
    // Employers CANNOT ADD Categories
    // Guests CANNOT ADD Categories
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

    // Admins CAN EDIT Categories
    // Agents CANNOT EDIT Categories
    // Employers CANNOT EDIT Categories
    // Guests CANNOT EDIT Categories
    public function update(User $user, Category $category)
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

    // Admins CAN DELETE Categories
    // Agents CANNOT DELETE Categories
    // Employers CANNOT DELETE Categories
    // Guests CANNOT DELETE Categories
    public function delete(User $user, Category $category)
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

    // Admins CAN RESTORE Categories
    // Agents CANNOT RESTORE Categories
    // Employers CANNOT RESTORE Categories
    // Guests CANNOT RESTORE Categories
    public function restore(User $user, Category $category)
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

    // Admins CAN FORCE DELETE Categories
    // Agents CANNOT FORCE DELETE Categories
    // Employers CANNOT FORCE Delete Categories
    // Guests CANNOT FORCE Delete Categories
    public function forceDelete(User $user, Category $category)
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
