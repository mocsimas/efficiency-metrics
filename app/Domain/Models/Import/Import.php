<?php

namespace App\Domain\Models\Import;

use App\Infrastructure\Base\BaseModel;
use App\Infrastructure\Enums\ImportTypeEnum;
use App\Infrastructure\Contracts\ResourceContract;
use App\Infrastructure\Resource\Import\ImportResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Infrastructure\Enums\TrackerEnum;

class Import extends BaseModel implements ResourceContract
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'started_at',
        'ended_at',
        'tracker',
        'type',
        'error_at',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'ended_at' => 'datetime',
        'tracker' => TrackerEnum::class,
        'type' => ImportTypeEnum::class,
        'error_at' => 'datetime',
    ];

    public function transform(): JsonResource {
        return new ImportResource($this);
    }

    public static function collection($data): JsonResource {
        return ImportResource::collection($data);
    }
}
