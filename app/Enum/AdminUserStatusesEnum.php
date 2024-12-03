<?php

namespace App\Enum;

enum AdminUserStatusesEnum: string
{
    case Approved = 'approved';
    case Pending = 'pending';
    case Rejected = 'rejected';

    public static function labels(): array
    {
        return [
            self::Approved->value => 'Approved',
            self::Pending->value => 'Pending',
            self::Rejected->value => 'Rejected',
        ];
    }
}
