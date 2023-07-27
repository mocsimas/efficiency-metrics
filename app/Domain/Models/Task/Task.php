<?php

namespace App\Domain\Models\Task;

use App\Domain\Models\Estimate\Estimate;
use App\Domain\Models\Project\Project;
use App\Domain\Models\TimeEntry\TimeEntry;
use App\Infrastructure\Base\BaseModel;
use App\Infrastructure\Contracts\ResourceContract;
use App\Infrastructure\Resource\Task\TaskResource;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Http\Resources\Json\JsonResource;

class Task extends BaseModel implements ResourceContract
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
        'duration',
    ];

    public function transform(): JsonResource {
        return new TaskResource($this);
    }

    public static function collection($data): JsonResource {
        return TaskResource::collection($data);
    }

    public function project() {
        return $this->belongsTo(Project::class, 'project_uuid', 'uuid');
    }

    public function timeEntries() {
        return $this->hasMany(TimeEntry::class, 'task_uuid', 'uuid');
    }

    public function estimate() {
        return $this->hasOne(Estimate::class, 'task_uuid', 'uuid');
    }

    public function scopeOfDate(Builder $query, int $year, int $month): Builder {
        return $query->whereRelation('timeEntries', function($query) use ($year, $month) {
            $query->whereYear('started_at', $year)
                ->whereMonth('started_at', $month);
        });
    }
}
