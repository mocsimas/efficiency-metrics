<?php

namespace App\Application\Providers;

use App\Domain\Events\Import\ImportEnded;
use App\Domain\Events\Import\ImportFailed;
use App\Domain\Events\Import\ImportStarted;
use App\Domain\Models\Import\Import;
use App\Domain\Models\Project\Project;
use App\Domain\Models\Task\Task;
use App\Domain\Models\TimeEntry\TimeEntry;
use App\Domain\Models\Tracker\Tracker;
use App\Domain\Models\User\User;
use App\Domain\Models\Workspace\Workspace;
use App\Infrastructure\Observers\ImportObserver;
use App\Infrastructure\Observers\ProjectObserver;
use App\Infrastructure\Observers\TaskObserver;
use App\Infrastructure\Observers\TimeEntryObserver;
use App\Infrastructure\Observers\TrackerObserver;
use App\Infrastructure\Observers\UserObserver;
use App\Infrastructure\Observers\WorkspaceObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        ImportStarted::class => [],
        ImportEnded::class => [],
        ImportFailed::class => [],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        Tracker::observe(TrackerObserver::class);
        User::observe(UserObserver::class);
        Workspace::observe(WorkspaceObserver::class);
        TimeEntry::observe(TimeEntryObserver::class);
        Import::observe(ImportObserver::class);
        Project::observe(ProjectObserver::class);
        Task::observe(TaskObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
