<?php

namespace App\Domain\Models\TimeEntry;

use App\Infrastructure\Base\BaseModel;
use App\Infrastructure\Enums\TrackerEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TimeEntry extends BaseModel
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

    public function transform() {
//        return new {{ resource }}($this);
    }

    //public static function transformCollection($data) {
    //    return {{ resource }}::collection($data);
    //}
}
