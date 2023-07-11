<?php

namespace App\Infrastructure\Enums;

use App\Domain\Services\Tracker\ClockifyService;
use App\Infrastructure\Facades\TrackerFacade;
use App\Infrastructure\Interfaces\TrackerServiceInterface;
use Illuminate\Support\Facades\Http;

enum TrackerEnum: string
{
    case CLOCKIFY = 'clockify';

//    case TOGGL = 'toggl';

    public function getHttpMacroName(): string {
        return $this->value;
    }

    public function getHttpMacro(): callable {
        $enum = $this;

        return match($this) {
            self::CLOCKIFY => function() use ($enum) {
                return Http::withHeaders(['X-Api-Key' => TrackerFacade::getTrackerApiKey($enum)])
                    ->baseUrl($enum->getHttpBaseUrl());
            },
        };
    }

    public function getHttpBaseUrl(): string {
        return match($this) {
            self::CLOCKIFY => 'https://api.clockify.me/api',
        };
    }

    public function getResource(): string {
        return match($this) {
            self::CLOCKIFY => 'clockify',
        };
    }

    public function getService(): TrackerServiceInterface {
        return match($this) {
            self::CLOCKIFY => new ClockifyService(),
        };
    }

    public function getTrackerIdKey($namespace): string {
        return match($this) {
            self::CLOCKIFY => match($namespace) {
                default => 'id',
            },
        };
    }

    public function getDefaultKey(): ?string {
        return match($this) {
            self::CLOCKIFY => config('tracker.clockify.api.key'),
        };
    }
}
