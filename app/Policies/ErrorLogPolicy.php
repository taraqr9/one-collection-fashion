<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\ErrorLog;
use Illuminate\Auth\Access\HandlesAuthorization;

class ErrorLogPolicy
{
    use HandlesAuthorization;

    public function viewAny(Admin $admin): bool
    {
        return $admin->can('view_any_error_log');
    }

    public function view(Admin $admin, ErrorLog $errorLog): bool
    {
        return $admin->can('view_error_log');
    }

    public function create(Admin $admin): bool
    {
        return $admin->can('create_error_log');
    }

    public function update(Admin $admin, ErrorLog $errorLog): bool
    {
        return $admin->can('update_error_log');
    }

    public function delete(Admin $admin, ErrorLog $errorLog): bool
    {
        return $admin->can('delete_error_log');
    }

    public function deleteAny(Admin $admin): bool
    {
        return $admin->can('delete_any_error_log');
    }
}

