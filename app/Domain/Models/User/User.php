<?php

namespace App\Domain\Models\User;

use App\Infrastructure\Base\BaseModel;
use App\Infrastructure\Enums\TrackerEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'name',
        'tracker',
        'tracker_user_id',
        'tracker_name',
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
