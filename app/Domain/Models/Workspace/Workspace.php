<?php

namespace App\Domain\Models\Workspace;

use App\Infrastructure\Base\BaseModel;
use App\Infrastructure\Enums\TrackerEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Workspace extends BaseModel
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

    //public function transform() {
    //    return new {{ resource }}($this);
    //}

    //public static function transformCollection($data) {
    //    return {{ resource }}::collection($data);
    //}
}
