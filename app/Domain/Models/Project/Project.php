<?php

namespace App\Domain\Models\Project;

use App\Domain\Models\Task\Task;
use App\Domain\Models\Workspace\Workspace;
use App\Infrastructure\Base\BaseModel;
use App\Infrastructure\Contracts\ResourceContract;
use App\Infrastructure\Resource\Project\ProjectResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Resources\Json\JsonResource;

class Project extends BaseModel implements ResourceContract
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

    public function workspace() {
        return $this->belongsTo(Workspace::class, 'workspace_uuid', 'uuid');
    }

    public function tasks() {
        return $this->hasMany(Task::class, 'project_uuid', 'uuid');
    }
}
