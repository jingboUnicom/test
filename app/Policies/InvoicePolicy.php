<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Invoice;
use Illuminate\Auth\Access\HandlesAuthorization;

class InvoicePolicy
{
    use HandlesAuthorization;

    // Admins CAN BROWSE Invoices
    // Employers CAN BROWSE Invoices
    // Guests CANNOT BROWSE Invoices
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

    // Admins CAN READ Invoices
    // Employers CAN READ Invoices
    // Guests CANNOT READ Invoices
    public function view(User $user, Invoice $companyInvoice)
    {
        if ($user->super) {
            return true;
        }

        if ($user->employer) {
            return true;
        }

        return false;
    }

    // Admins CAN ADD Invoices
    // Employers CANNOT ADD Invoices
    // Guests CANNOT ADD Invoices
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

    // Admins CAN EDIT Invoices
    // Employers CANNOT EDIT Invoices
    // Guests CANNOT EDIT Invoices
    public function update(User $user, Invoice $companyInvoice)
    {
        if ($user->super) {
            return true;
        }

        if ($user->employer) {
            return false;
        }

        return false;
    }

    // Admins CAN DELETE Invoices
    // Employers CANNOT DELETE Invoices
    // Guests CANNOT DELETE Invoices
    public function delete(User $user, Invoice $companyInvoice)
    {
        if ($user->super) {
            return true;
        }

        if ($user->employer) {
            return false;
        }

        return false;
    }

    // Admins CAN RESTORE Invoices
    // Employers CANNOT RESTORE Invoices
    // Guests CANNOT RESTORE Invoices
    public function restore(User $user, Invoice $companyInvoice)
    {
        if ($user->super) {
            return true;
        }


        if ($user->employer) {
            return false;
        }

        return false;
    }

    // Admins CAN FORCE DELETE Invoices
    // Employers CANNOT FORCE DELETE Invoices
    // Guests CANNOT FORCE DELETE Invoices
    public function forceDelete(User $user, Invoice $companyInvoice)
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
