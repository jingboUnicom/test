<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Subcategory;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubcategoryPolicy
{
    use HandlesAuthorization;

    // Admins CAN BROWSE Subcategories
    // Employers CANNOT BROWSE Subcategories
    // Guests CANNOT BROWSE Subcategories
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

    // Admins CAN READ Subcategories
    // Employers CANNOT READ Subcategories
    // Guests CANNOT READ Subcategories
    public function view(User $user, Subcategory $category)
    {
        if ($user->super) {
            return true;
        }

        if ($user->employer) {
            return false;
        }

        return false;
    }

    // Admins CAN ADD Subcategories
    // Employers CANNOT ADD Subcategories
    // Guests CANNOT ADD Subcategories
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

    // Admins CAN EDIT Subcategories
    // Employers CANNOT EDIT Subcategories
    // Guests CANNOT EDIT Subcategories
    public function update(User $user, Subcategory $category)
    {
        if ($user->super) {
            return true;
        }

        if ($user->employer) {
            return false;
        }

        return false;
    }

    // Admins CAN DELETE Subcategories
    // Employers CANNOT DELETE Subcategories
    // Guests CANNOT DELETE Subcategories
    public function delete(User $user, Subcategory $category)
    {
        if ($user->super) {
            return true;
        }

        if ($user->employer) {
            return false;
        }

        return false;
    }

    // Admins CAN RESTORE Subcategories
    // Employers CANNOT RESTORE Subcategories
    // Guests CANNOT RESTORE Subcategories
    public function restore(User $user, Subcategory $category)
    {
        if ($user->super) {
            return true;
        }

        if ($user->employer) {
            return false;
        }

        return false;
    }

    // Admins CAN FORCE DELETE Subcategories
    // Employers CANNOT FORCE Delete Subcategories
    // Guests CANNOT FORCE Delete Subcategories
    public function forceDelete(User $user, Subcategory $category)
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
