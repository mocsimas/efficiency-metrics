<?php

namespace App\Domain\Models\Project;

use App\Infrastructure\Base\BaseModel;
use App\Infrastructure\Interfaces\ResourceInterface;
use App\Infrastructure\Resource\Project\ProjectResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Resources\Json\JsonResource;

class Project extends BaseModel implements ResourceInterface
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'title',
        'tracker',
        'tracker_id',
        'tracker_title',
        'import_date',
        'workspace_uuid',
    ];

    public function transform(): JsonResource {
        return new ProjectResource($this);
    }

    public static function collection($data): JsonResource {
        return ProjectResource::collection($data);
    }
}
