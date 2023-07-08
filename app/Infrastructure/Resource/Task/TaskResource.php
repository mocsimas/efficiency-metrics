<?php

namespace App\Infrastructure\Resource\Task;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        // TODO: fill resource
        return parent::toArray($request);
    }
}
