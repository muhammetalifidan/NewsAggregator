<?php

namespace App\Enum;

enum CallbackLogStatusType: string
{
    case Pending = 'pending';
    case Confirmed = 'confirmed';
}
