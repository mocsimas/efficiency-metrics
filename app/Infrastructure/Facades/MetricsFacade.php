<?php

namespace App\Infrastructure\Facades;

use App\Domain\Models\Workspace\Workspace;
use Illuminate\Support\Facades\Facade;

/**
 * @method static string workspaceDuration(int $year, int $month, ?Workspace $workspace)
 */
class MetricsFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'metrics';
    }
}
