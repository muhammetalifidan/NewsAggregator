<?php

namespace Database\Seeders;

use App\Enum\PermissionsEnum;
use App\Enum\RolesEnum;
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
        $superAdminRole = Role::create(['name' => RolesEnum::SuperAdmin->value, 'guard_name' => 'admin']);
        $adminRole = Role::create(['name' => RolesEnum::Admin->value, 'guard_name' => 'admin']);
        $userRole = Role::create(['name' => RolesEnum::User->value, 'guard_name' => 'admin']);

        $listAdminUsersPermission = Permission::create(['name' => PermissionsEnum::ListAdminUsers->value, 'guard_name' => 'admin']);
        $showAnyAdminUserPermission = Permission::create(['name' => PermissionsEnum::ShowAnyAdminUser->value, 'guard_name' => 'admin']);
        $showOwnAdminUserPermission = Permission::create(['name' => PermissionsEnum::ShowOwnAdminUser->value, 'guard_name' => 'admin']);
        $updateOwnAdminUserPermission = Permission::create(['name' => PermissionsEnum::UpdateOwnAdminUser->value, 'guard_name' => 'admin']);
        $destroyOwnAdminUserPermission = Permission::create(['name' => PermissionsEnum::DestroyOwnAdminUser->value, 'guard_name' => 'admin']);
        $listIncomingLogsPermission = Permission::create(['name' => PermissionsEnum::ListIncomingLogs->value, 'guard_name' => 'admin']);
        $showAnyIncomingLogPermission = Permission::create(['name' => PermissionsEnum::ShowAnyIncomingLog->value, 'guard_name' => 'admin']);
        $listCallbackLogsPermission = Permission::create(['name' => PermissionsEnum::ListCallbackLogs->value, 'guard_name' => 'admin']);
        $showAnyCallbackLogPermission = Permission::create(['name' => PermissionsEnum::ShowAnyCallbackLog->value, 'guard_name' => 'admin']);

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
            'status' => 'approved',
        ])->assignRole($superAdminRole);

        AdminUser::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'status' => 'approved',
        ])->assignRole($adminRole);

        AdminUser::create([
            'name' => 'User User',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'status' => 'pending',
        ])->assignRole($userRole);

        AdminUser::factory(17)->create()->each(function ($user) {
            $user->assignRole(RolesEnum::User);
        });

        IncomingLogData::factory(20)->create();
        IncomingLog::factory(20)->create();
        CallbackLog::factory(20)->create();
    }
}
