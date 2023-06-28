<?php

namespace App\Infrastructure\Interfaces;

use Illuminate\Http\Resources\Json\JsonResource;

interface ResourceInterface
{
    public function transform(): JsonResource;

    public static function collection($data): JsonResource;
}
