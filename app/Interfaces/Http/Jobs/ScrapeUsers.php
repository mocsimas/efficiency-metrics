<?php

namespace App\Interfaces\Http\Jobs;

use App\Domain\Services\UserService;
use App\Infrastructure\Enums\TrackerEnum;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class ScrapeUsers implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        private readonly TrackerEnum $trackerEnum,
        private readonly Collection $users,
    ) {}

    public function handle(UserService $service): void
    {
        $service->createUsers($this->trackerEnum, $this->users, new \DateTime());
    }
}
