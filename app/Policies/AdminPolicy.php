<?php

namespace App\Policies;

use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the admin can view any models.
     */
    public function viewAny(Admin $admin): bool
    {
        return $admin->can('view_any_admin');
    }

    /**
     * Determine whether the admin can view the model.
     */
    public function view(Admin $admin): bool
    {
        return $admin->can('view_admin');
    }

    /**
     * Determine whether the admin can create models.
     */
    public function create(Admin $admin): bool
    {
        return $admin->can('create_admin');
    }

    /**
     * Determine whether the admin can update the model.
     */
    public function update(Admin $admin): bool
    {
        return $admin->can('update_admin');
    }

    /**
     * Determine whether the admin can delete the model.
     */
    public function delete(Admin $admin): bool
    {
        return $admin->can('delete_admin');
    }

    /**
     * Determine whether the admin can bulk delete.
     */
    public function deleteAny(Admin $admin): bool
    {
        return $admin->can('delete_any_admin');
    }
}
