<?php

namespace App\Infrastructure\Enums;

enum ImportTypeEnum: string
{
    case ALL = 'all';

    case USERS = 'users';

    case WORKSPACES = 'workspaces';

    case TIME_ENTRIES = 'time_entries';
}
