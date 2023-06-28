<?php

namespace App\Domain\Models\TimeEntry;

use App\Infrastructure\Base\BaseModel;
use App\Infrastructure\Enums\TrackerEnum;
use App\Infrastructure\Interfaces\ResourceInterface;
use App\Infrastructure\Resource\TimeEntry\TimeEntryResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

class TimeEntry extends BaseModel implements ResourceInterface
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'title',
        'started_at',
        'ended_at',
        'duration',
        'tracker',
        'tracker_time_entry_id',
        'tracker_title',
        'tracker_user_id',
//        'workspace_uuid',
//        'project_uuid',
//        'task_uuid',
    ];

    protected $casts = [
        'tracker' => TrackerEnum::class,
        'started_at' => 'datetime',
        'ended_at' => 'datetime',
    ];

    public function transform(): JsonResource {
        return new TimeEntryResource($this);
    }

    public static function collection($data): JsonResource {
        return TimeEntryResource::collection($data);
    }
}
