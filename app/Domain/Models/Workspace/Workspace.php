<?php

namespace App\Domain\Models\Workspace;

use App\Infrastructure\Base\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Workspace extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'title',
        'tracker',
    ];

    //public function transform() {
    //    return new {{ resource }}($this);
    //}

    //public static function transformCollection($data) {
    //    return {{ resource }}::collection($data);
    //}
}
