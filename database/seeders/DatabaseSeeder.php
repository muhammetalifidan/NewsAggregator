<?php

namespace Database\Seeders;

use App\Enum\PermissionsEnum;
use App\Enum\RolesEnum;
use App\Models\AdminUser;
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

        $userRole->syncPermissions([
            $showOwnAdminUserPermission,
            $updateOwnAdminUserPermission,
            $destroyOwnAdminUserPermission
        ]);

        $adminRole->syncPermissions([
            $listAdminUsersPermission,
            $showAnyAdminUserPermission,
            $showOwnAdminUserPermission,
            $updateOwnAdminUserPermission,
            $destroyOwnAdminUserPermission
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
    }
}
