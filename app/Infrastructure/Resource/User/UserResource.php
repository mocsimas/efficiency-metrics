<?php

namespace App\Infrastructure\Resource\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        // TODO: fill resource
        return parent::toArray($request);
    }
}
