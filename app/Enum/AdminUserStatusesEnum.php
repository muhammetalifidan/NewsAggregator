<?php

namespace App\Enum;

enum AdminUserStatusesEnum: string
{
    case Approved = 'approved';
    case Pending = 'pending';
    case Rejected = 'rejected';
}
