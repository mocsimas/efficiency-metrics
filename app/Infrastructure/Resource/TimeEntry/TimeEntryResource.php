<?php

namespace App\Infrastructure\Resource\TimeEntry;

use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TimeEntryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'uuid' => $this->uuid,
            'title' => $this->title,
            'started_at' => $this->started_at->format('Y-m-d H:i:s'),
            'ended_at' => $this->ended_at->format('Y-m-d H:i:s'),
            'duration' => $this->formatDuration($this->duration),
            'tracker' => $this->tracker,
//            'tracker_time_entry_id' => $this->tracker_time_entry_id,
//            'tracker_title' => $this->tracker_title,
//            'tracker_user_id' => $this->tracker_user_id,
        ];
    }

    private function formatDuration($seconds): string {
        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds % 3600) / 60);
        $remainingSeconds = $seconds % 60;

        return sprintf('%02d:%02d:%02d', $hours, $minutes, $remainingSeconds);
    }
}
