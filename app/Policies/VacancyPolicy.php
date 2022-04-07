<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Vacancy;
use Illuminate\Auth\Access\HandlesAuthorization;

class VacancyPolicy
{
    use HandlesAuthorization;

    // Admins CAN BROWSE Company Vacancies
    // Agents CAN BROWSE Company Vacancies
    // Employers CAN BROWSE Company Vacancies
    // Guests CANNOT BROWSE Company Vacancies
    public function viewAny(User $user)
    {
        if ($user->super) {
            return true;
        }

        if ($user->agent) {
            return true;
        }

        if ($user->employer) {
            return true;
        }

        return false;
    }

    // Admins CAN READ Company Vacancies
    // Agents CAN READ Company Vacancies
    // Employers CAN READ Company Vacancies
    // Guests CANNOT READ Company Vacancies
    public function view(User $user, Vacancy $vacancy)
    {
        if ($user->super) {
            return true;
        }

        if ($user->agent) {
            return true;
        }

        if ($user->employer) {
            return true;
        }

        return false;
    }

    // Admins CAN ADD Company Vacancies
    // Agents CAN ADD Company Vacancies
    // Employers CAN ADD Company Vacancies
    // Guests CANNOT ADD Company Vacancies
    public function create(User $user)
    {
        if ($user->super) {
            return true;
        }

        if ($user->agent) {
            return true;
        }

        if ($user->employer) {
            return true;
        }

        return false;
    }

    // Admins CAN EDIT Company Vacancies
    // Agents CAN EDIT Company Vacancies
    // Employers CAN EDIT Company Vacancies
    // Guests CANNOT EDIT Company Vacancies
    public function update(User $user, Vacancy $vacancy)
    {
        if ($user->super) {
            return true;
        }

        if ($user->agent) {
            return true;
        }

        if ($user->employer) {
            return true;
        }

        return false;
    }

    // Admins CAN DELETE Company Vacancies
    // Agents CANNOT DELETE Company Vacancies
    // Employers CANNOT DELETE Company Vacancies
    // Guests CANNOT DELETE Company Vacancies
    public function delete(User $user, Vacancy $vacancy)
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

    // Admins CAN RESTORE Company Vacancies
    // Agents CANNOT RESTORE Company Vacancies
    // Employers CANNOT RESTORE Company Vacancies
    // Guests CANNOT RESTORE Company Vacancies
    public function restore(User $user, Vacancy $vacancy)
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

    // Admins CAN FORCE DELETE Company Vacancies
    // Agents CANNOT FORCE DELETE Company Vacancies
    // Employers CANNOT FORCE DELETE  Company Vacancies
    // Guests CANNOT FORCE DELETE  Company Vacancies
    public function forceDelete(User $user, Vacancy $vacancy)
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
