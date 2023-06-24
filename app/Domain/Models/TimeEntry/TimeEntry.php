<?php

namespace App\Domain\Models\TimeEntry;

use App\Infrastructure\Base\BaseModel;
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
        'workspace_uuid',
        'project_uuid',
        'task_uuid',
    ];

    //public function transform() {
    //    return new {{ resource }}($this);
    //}

    //public static function transformCollection($data) {
    //    return {{ resource }}::collection($data);
    //}
}
