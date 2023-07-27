<?php

namespace App\Infrastructure\Contracts;

use Illuminate\Http\Resources\Json\JsonResource;

interface ResourceContract
{
    public function transform(): JsonResource;

    public static function collection($data): JsonResource;
}
