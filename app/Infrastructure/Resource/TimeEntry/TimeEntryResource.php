<?php

namespace App\Infrastructure\Resource\TimeEntry;

use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Time;

class TimeEntryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'uuid' => $this->uuid,
            'title' => $this->title,
            'started_at' => $this->started_at->format('Y-m-d H:i:s'),
            'ended_at' => $this->ended_at->format('Y-m-d H:i:s'),
            'duration' => Time::secondsToDuration($this->duration),
            'tracker' => $this->tracker,
            'date' => $this->started_at->format('Y-m-d'),
            'workspace' => $this->workspace->transform(),
//            'tracker_id' => $this->tracker_id,
//            'tracker_title' => $this->tracker_title,
//            'tracker_id' => $this->tracker_id,
        ];
    }
}
