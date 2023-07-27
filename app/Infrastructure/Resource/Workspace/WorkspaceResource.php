<?php

namespace App\Infrastructure\Resource\Workspace;

use App\Infrastructure\Facades\MetricsFacade;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkspaceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $date = Carbon::now();

        $latestDurations = [];
        foreach(range(1, 3) as $index) {
            $latestDurations[$date->format('Y-m')] = MetricsFacade::workspaceDuration($date->year, $date->month, $this->resource);

            $date->subMonth();
        }

        return [
            'uuid' => $this->uuid,
            'title' => $this->title,
            'durations' => $latestDurations,
        ];
    }
}
