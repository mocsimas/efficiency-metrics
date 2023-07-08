<?php

namespace App\Domain\Models\Task;

use App\Infrastructure\Base\BaseModel;
use App\Infrastructure\Interfaces\ResourceInterface;
use App\Infrastructure\Resource\Task\TaskResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Resources\Json\JsonResource;

class Task extends BaseModel implements ResourceInterface
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'title',
        'tracker',
        'tracker_id',
        'tracker_title',
        'import_date',
        'project_uuid',
    ];

    public function transform(): JsonResource {
        return new TaskResource($this);
    }

    public static function collection($data): JsonResource {
        return TaskResource::collection($data);
    }
}
