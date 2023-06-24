<?php

namespace App\Domain\Models\Tracker;

use App\Infrastructure\Base\BaseModel;
use App\Infrastructure\Enums\TrackerEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tracker extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'type',
        'key',
    ];

    protected $casts = [
        'type' => TrackerEnum::class
    ];
}
