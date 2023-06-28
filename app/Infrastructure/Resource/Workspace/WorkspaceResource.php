<?php

namespace App\Infrastructure\Resource\Workspace;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkspaceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        // TODO: fill resource
        return parent::toArray($request);
    }
}
