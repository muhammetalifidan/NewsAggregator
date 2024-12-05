<?php

namespace App\Policies;

use App\Enum\PermissionsEnum;
use App\Enum\RolesEnum;
use App\Models\AdminUser;
use App\Models\CallbackLog;

class CallbackLogPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(AdminUser $adminUser): bool
    {
        if ($adminUser->hasRole(RolesEnum::SuperAdmin)) {
            return true;
        }

        if ($adminUser->can(PermissionsEnum::ListCallbackLogs)) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(AdminUser $adminUser): bool
    {
        if ($adminUser->hasRole(RolesEnum::SuperAdmin)) {
            return true;
        }

        if ($adminUser->can(PermissionsEnum::ShowAnyCallbackLog)) {
            return true;
        }

        return false;
    }
}
