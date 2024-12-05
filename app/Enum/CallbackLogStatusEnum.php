<?php

namespace App;

enum CallbackLogStatusEnum
{
    case Pending = 'pending';
    case Confirmed = 'confirmed';

    public static function labels(): array
    {
        return [
            self::Pending->value = 'Pending',
            self::Confirmed->value = 'Confirmed',
        ];
    }
}
