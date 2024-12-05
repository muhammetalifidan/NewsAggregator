<?php

namespace App\Policies;

use App\Enum\PermissionType;
use App\Enum\RoleType;
use App\Models\AdminUser;

class IncomingLogPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(AdminUser $adminUser): bool
    {
        if ($adminUser->hasRole(RoleType::SuperAdmin)) {
            return true;
        }

        if ($adminUser->can(PermissionType::ListIncomingLogs)) {
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

        if ($adminUser->can(PermissionType::ShowAnyIncomingLog)) {
            return true;
        }

        return false;
    }
}
