<?php

namespace App\Domain\Models\Workspace;

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
        'tracker_workspace_id',
        'tracker_title',
    ];

    protected $casts = [
        'tracker' => TrackerEnum::class
    ];

    public function transform(): JsonResource {
        return new WorkspaceResource($this);
    }

    public static function collection($data): JsonResource {
        return WorkspaceResource::collection($data);
    }
}
