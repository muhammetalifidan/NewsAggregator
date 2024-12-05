<?php

namespace App\Policies;

use App\Enum\PermissionType;
use App\Enum\RoleType;
use App\Models\AdminUser;

class AdminUserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(AdminUser $adminUser): bool
    {
        if ($adminUser->hasRole(RoleType::SuperAdmin->value)) {
            return true;
        }

        if ($adminUser->can(PermissionType::ListAdminUsers->value)) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(AdminUser $adminUser, $id): bool
    {
        if ($adminUser->hasRole(RoleType::SuperAdmin->value)) {
            return true;
        }

        if ($adminUser->can(PermissionType::ShowAnyAdminUser->value)) {
            return true;
        }

        if ($adminUser->can(PermissionType::ShowOwnAdminUser)) {
            return $adminUser->id === $id;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(AdminUser $adminUser, $id): bool
    {
        if ($adminUser->hasRole(RoleType::SuperAdmin->value)) {
            return true;
        }

        if ($adminUser->can(PermissionType::UpdateOwnAdminUser)) {
            return $adminUser->id === $id;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function destroy(AdminUser $adminUser, $id): bool
    {
        if ($adminUser->hasRole(RoleType::SuperAdmin->value)) {
            return true;
        }

        if ($adminUser->can(PermissionType::DestroyOwnAdminUser)) {
            return $adminUser->id === $id;
        }

        return false;
    }

    public function manageRole(AdminUser $adminUser): bool
    {
        if ($adminUser->hasRole(RoleType::SuperAdmin->value)) {
            return true;
        }

        return false;
    }
}
