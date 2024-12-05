<?php

namespace App\Enum;

enum PermissionsEnum: string
{
    case ListAdminUsers = 'list.admin-users';
    case ShowAnyAdminUser = 'show.any.admin-user';
    case ShowOwnAdminUser = 'show.own.admin-user';
    case UpdateOwnAdminUser = 'update.own.admin-user';
    case DestroyOwnAdminUser = 'destroy.own.admin-user';
    case ListIncomingLogs = 'list.incoming.logs';
    case ShowAnyIncomingLog = 'show.any.incoming.log';
    case ListCallbackLogs = 'list.callback.logs';
    case ShowAnyCallbackLog = 'show.any.callback.log';
}
