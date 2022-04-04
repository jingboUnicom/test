<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Category;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

    // Agents CANNOT BROWSE Categorys
    // Employers CANNOT BROWSE Categorys
    public function viewAny(User $user)
    {
        if ($user->agent) {
            return false;
        }

        if ($user->employer) {
            return false;
        }
    }

    // Agents CANNOT READ Categorys
    // Employers CANNOT READ Categorys
    public function view(User $user, Category $category)
    {
        if ($user->agent) {
            return false;
        }

        if ($user->employer) {
            return false;
        }
    }

    // Agents CANNOT ADD Categorys
    // Employers CANNOT ADD Categorys
    public function create(User $user)
    {
        if ($user->agent) {
            return false;
        }

        if ($user->employer) {
            return false;
        }
    }

    // Agents CANNOT EDIT Categorys
    // Employers CANNOT EDIT Categorys
    public function update(User $user, Category $category)
    {
        if ($user->agent) {
            return false;
        }

        if ($user->employer) {
            return false;
        }
    }

    // Agents CANNOT DELETE Categorys
    // Employers CANNOT DELETE Categorys
    public function delete(User $user, Category $category)
    {
        if ($user->agent) {
            return false;
        }

        if ($user->employer) {
            return false;
        }
    }

    // Agents CANNOT RESTORE Categorys
    // Employers CANNOT RESTORE Categorys
    public function restore(User $user, Category $category)
    {
        if ($user->agent) {
            return false;
        }

        if ($user->employer) {
            return false;
        }
    }

    // Agents CANNOT FORCE DELETE Categorys
    // Employers CANNOT FORCE Delete Categorys
    public function forceDelete(User $user, Category $category)
    {
        if ($user->agent) {
            return false;
        }

        if ($user->employer) {
            return false;
        }
    }
}
