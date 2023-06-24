<?php

namespace App\Infrastructure\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static string getTrackerApiKey(\App\Infrastructure\Enums\TrackerEnum $enum)
 */
class TrackerFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'tracker';
    }
}
