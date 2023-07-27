<?php

namespace App\Domain\Models\Estimate;

use App\Domain\Models\Task\Task;
use App\Infrastructure\Base\BaseModel;
use App\Infrastructure\Contracts\ResourceContract;
use App\Infrastructure\Resource\Estimate\EstimateResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Resources\Json\JsonResource;

class Estimate extends BaseModel implements ResourceContract
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'task_uuid',
        'from',
        'to',
    ];

    public function transform(): JsonResource {
        return new EstimateResource($this);
    }

    public static function collection($data): JsonResource {
        return EstimateResource::collection($data);
    }

    public function task() {
        return $this->belongsTo(Task::class, 'task_uuid', 'uuid');
    }
}
