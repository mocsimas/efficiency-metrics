<?php

namespace App\Domain\Models\User;

use App\Infrastructure\Base\BaseModel;
use App\Infrastructure\Enums\TrackerEnum;
use App\Infrastructure\Interfaces\ResourceInterface;
use App\Infrastructure\Resource\User\UserResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Resources\Json\JsonResource;

class User extends BaseModel implements ResourceInterface
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'name',
        'tracker',
        'tracker_id',
        'tracker_name',
        'import_date',
    ];

    protected $casts = [
        'tracker' => TrackerEnum::class,
        'import_date' => 'datetime',
    ];

    public function transform(): JsonResource {
        return new UserResource($this);
    }

    public static function collection($data): JsonResource {
        return UserResource::collection($data);
    }
}
