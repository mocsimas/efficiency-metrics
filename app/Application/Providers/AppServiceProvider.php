<?php

namespace App\Application\Providers;

use App\Domain\Services\ClockifyService;
use App\Domain\Services\TimeService;
use App\Domain\Services\TrackerService;
use App\Infrastructure\Enums\TrackerEnum;
use App\Infrastructure\Interfaces\TrackerServiceInterface;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Facade bind
        $this->app->bind('tracker', function() {
            return new TrackerService();
        });
        $this->app->bind('time', function() {
            return new TimeService();
        });

        // Tracker controller dependency injection bind
        $this->app->bind(TrackerServiceInterface::class, function($app) {
            $tracker = request()->route()?->parameter('tracker');

            $trackerEnum = TrackerEnum::tryFrom($tracker);

            if(!$trackerEnum)
                throw new NotFoundHttpException('Page Not Found');

            return $app->make($trackerEnum->getService()::class);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
    }
}
