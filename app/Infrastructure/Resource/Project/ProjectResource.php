<?php

namespace App\Infrastructure\Resource\Project;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        // TODO: fill resource
        return parent::toArray($request);
    }
}
