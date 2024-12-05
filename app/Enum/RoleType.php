<?php

namespace App\Enum;

enum RoleType: string
{
    case SuperAdmin = 'super-admin';
    case Admin = 'admin';
    case User = 'user';

    public static function labels(): array
    {
        return [
            self::SuperAdmin->value => 'Super Admin',
            self::Admin->value => 'Admin',
            self::User->value => 'User',
        ];
    }
}
