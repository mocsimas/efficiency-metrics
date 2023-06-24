<?php

namespace App\Application\Providers;

use App\Domain\Models\Tracker\TrackerRepository;
use App\Infrastructure\Enums\TrackerEnum;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

class TrackerServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        foreach(TrackerEnum::cases() as $tracker)
            Http::macro($tracker->getHttpMacroName(), $tracker->getHttpMacro());
    }
}
