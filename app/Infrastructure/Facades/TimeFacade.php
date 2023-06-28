<?php

namespace App\Infrastructure\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static string secondsToDuration(int $seconds)
 */
class TimeFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'time';
    }
}
