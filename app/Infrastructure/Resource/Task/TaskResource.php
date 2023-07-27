<?php

namespace App\Infrastructure\Resource\Task;

use App\Infrastructure\Facades\TimeFacade;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'uuid' => $this->uuid,
            'title' => $this->title,
            'project' => $this->project->transform(),
            'duration' => TimeFacade::secondsToDuration($this->duration ?? $this->timeEntries()->sum('duration')),
            'project_uuid' => $this->project_uuid,
        ];
    }
}
