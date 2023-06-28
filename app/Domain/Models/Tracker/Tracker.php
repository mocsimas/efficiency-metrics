<?php

namespace App\Domain\Models\Tracker;

use App\Infrastructure\Base\BaseModel;
use App\Infrastructure\Enums\TrackerEnum;
use App\Infrastructure\Interfaces\ResourceInterface;
use App\Infrastructure\Resource\Tracker\TrackerResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Resources\Json\JsonResource;

class Tracker extends BaseModel implements ResourceInterface
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'type',
        'key',
    ];

    protected $casts = [
        'type' => TrackerEnum::class
    ];

    public function transform(): JsonResource {
        return new TrackerResource($this);
    }

    public static function collection($data): JsonResource {
        return TrackerResource::collection($data);
    }
}
