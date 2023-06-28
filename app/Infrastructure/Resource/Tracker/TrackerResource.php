<?php

namespace App\Infrastructure\Resource\Tracker;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TrackerResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        // TODO: fill resource
        return parent::toArray($request);
    }
}
