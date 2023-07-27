<?php

namespace App\Application\Providers;

use App\Domain\Services\MetricsService;
use App\Domain\Services\TimeService;
use App\Domain\Services\TrackerService;
use App\Infrastructure\Base\BaseController;
use App\Infrastructure\Contracts\Request\CreateRequestContract;
use App\Infrastructure\Contracts\Request\UpdateRequestContract;
use App\Infrastructure\Enums\TrackerEnum;
use App\Infrastructure\Contracts\TrackerServiceContract;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
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
        $this->app->bind('metrics', function() {
            return new MetricsService();
        });

        // Tracker controller dependency injection bind
        $this->app->bind(TrackerServiceContract::class, function($app) {
            $tracker = request()->route()?->parameter('tracker');

            $trackerEnum = TrackerEnum::tryFrom($tracker);

            if(!$trackerEnum)
                throw new NotFoundHttpException('Page Not Found');

            return $app->make($trackerEnum->getService()::class);
        });

        $this->app->bind(CreateRequestContract::class, function($app) {
            return $app->make($this->getCurrentController()->getCreateRequest());
        });

        $this->app->bind(UpdateRequestContract::class, function($app) {
            return $app->make($this->getCurrentController()->getUpdateRequest());
        });
    }

    /**
     * Get the current controller instance.
     *
     * @return BaseController|null
     */
    private function getCurrentController()
    {
        $route = app('router')->getCurrentRoute();

        if ($route) {
            $controller = $route->getController();

            if ($controller instanceof BaseController)
                return $controller;
        }

        return null;
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
    }
}
