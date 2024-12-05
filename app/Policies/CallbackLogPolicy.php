<?php

namespace App\Policies;

use App\Enum\PermissionType;
use App\Enum\RoleType;
use App\Models\AdminUser;

class CallbackLogPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(AdminUser $adminUser): bool
    {
        if ($adminUser->hasRole(RoleType::SuperAdmin)) {
            return true;
        }

        if ($adminUser->can(PermissionType::ListCallbackLogs)) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(AdminUser $adminUser): bool
    {
        if ($adminUser->hasRole(RoleType::SuperAdmin)) {
            return true;
        }

        if ($adminUser->can(PermissionType::ShowAnyCallbackLog)) {
            return true;
        }

        return false;
    }
}
