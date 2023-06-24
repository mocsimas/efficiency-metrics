<?php

namespace App\Infrastructure\Enums;

use App\Domain\Services\ClockifyService;
use Illuminate\Support\Facades\Http;
use Tracker;

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
                return Http::withHeaders(['X-Api-Key' => Tracker::getTrackerApiKey($enum)])
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

    public function getService(): string {
        return match($this) {
            self::CLOCKIFY => ClockifyService::class,
        };
    }
}
