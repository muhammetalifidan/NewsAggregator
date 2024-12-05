<?php

namespace Database\Seeders;

use App\Enum\PermissionType;
use App\Enum\RoleType;
use App\Models\AdminUser;
use App\Models\CallbackLog;
use App\Models\IncomingLog;
use App\Models\IncomingLogData;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $superAdminRole = Role::create(['name' => RoleType::SuperAdmin->value, 'guard_name' => 'admin']);
        $adminRole = Role::create(['name' => RoleType::Admin->value, 'guard_name' => 'admin']);
        $userRole = Role::create(['name' => RoleType::User->value, 'guard_name' => 'admin']);

        $listAdminUsersPermission = Permission::create(['name' => PermissionType::ListAdminUsers->value, 'guard_name' => 'admin']);
        $showAnyAdminUserPermission = Permission::create(['name' => PermissionType::ShowAnyAdminUser->value, 'guard_name' => 'admin']);
        $showOwnAdminUserPermission = Permission::create(['name' => PermissionType::ShowOwnAdminUser->value, 'guard_name' => 'admin']);
        $updateOwnAdminUserPermission = Permission::create(['name' => PermissionType::UpdateOwnAdminUser->value, 'guard_name' => 'admin']);
        $destroyOwnAdminUserPermission = Permission::create(['name' => PermissionType::DestroyOwnAdminUser->value, 'guard_name' => 'admin']);
        $listIncomingLogsPermission = Permission::create(['name' => PermissionType::ListIncomingLogs->value, 'guard_name' => 'admin']);
        $showAnyIncomingLogPermission = Permission::create(['name' => PermissionType::ShowAnyIncomingLog->value, 'guard_name' => 'admin']);
        $listCallbackLogsPermission = Permission::create(['name' => PermissionType::ListCallbackLogs->value, 'guard_name' => 'admin']);
        $showAnyCallbackLogPermission = Permission::create(['name' => PermissionType::ShowAnyCallbackLog->value, 'guard_name' => 'admin']);

        $userRole->syncPermissions([
            $showOwnAdminUserPermission,
            $updateOwnAdminUserPermission,
            $destroyOwnAdminUserPermission,
            $listIncomingLogsPermission,
            $showAnyIncomingLogPermission,
            $listCallbackLogsPermission,
            $showAnyCallbackLogPermission,
        ]);

        $adminRole->syncPermissions([
            $listAdminUsersPermission,
            $showAnyAdminUserPermission,
            $showOwnAdminUserPermission,
            $updateOwnAdminUserPermission,
            $destroyOwnAdminUserPermission,
            $listIncomingLogsPermission,
            $showAnyIncomingLogPermission,
            $listCallbackLogsPermission,
            $showAnyCallbackLogPermission,
        ]);

        AdminUser::create([
            'name' => 'Super User',
            'email' => 'super@example.com',
            'password' => Hash::make('password'),
        ])->assignRole($superAdminRole);

        AdminUser::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ])->assignRole($adminRole);

        AdminUser::create([
            'name' => 'User User',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
        ])->assignRole($userRole);

        AdminUser::factory(17)->create()->each(function ($user) {
            $user->assignRole(RoleType::User);
        });

        IncomingLogData::factory(20)->create();
        IncomingLog::factory(20)->create();
        CallbackLog::factory(20)->create();
    }
}
