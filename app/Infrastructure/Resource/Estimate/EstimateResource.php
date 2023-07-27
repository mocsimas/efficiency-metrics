<?php

namespace App\Infrastructure\Resource\Estimate;

use App\Infrastructure\Facades\TimeFacade;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EstimateResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'uuid' => $this->uuid,
            'task_uuid' => $this->task_uuid,
            'from' => $this->from,
            'to' => $this->to,
            'duration' => [
                'from' => TimeFacade::secondsToDuration($this->from),
                'to' => TimeFacade::secondsToDuration($this->to),
            ],
        ];
    }
}
