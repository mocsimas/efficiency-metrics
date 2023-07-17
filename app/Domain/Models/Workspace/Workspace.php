<?php

namespace App\Domain\Models\Workspace;

use App\Domain\Models\Estimate\Estimate;
use App\Domain\Models\Project\Project;
use App\Domain\Models\Task\Task;
use App\Infrastructure\Base\BaseModel;
use App\Infrastructure\Enums\TrackerEnum;
use App\Infrastructure\Interfaces\ResourceInterface;
use App\Infrastructure\Resource\Workspace\WorkspaceResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Resources\Json\JsonResource;

class Workspace extends BaseModel implements ResourceInterface
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'title',
        'tracker',
        'tracker_id',
        'tracker_title',
        'import_date',
    ];

    protected $casts = [
        'tracker' => TrackerEnum::class,
        'import_date' => 'datetime',
    ];

    public function transform(): JsonResource {
        return new WorkspaceResource($this);
    }

    public static function collection($data): JsonResource {
        return WorkspaceResource::collection($data);
    }

    public function projects() {
        return $this->hasMany(Project::class, 'uuid', 'workspace_uuid');
    }

    public function tasks() {
        return $this->hasManyThrough(Task::class, Project::class);
    }
}
