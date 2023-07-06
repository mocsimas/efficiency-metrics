<?php

namespace App\Domain\Models\User;

use App\Infrastructure\Base\ResourceRepository;
use App\Infrastructure\Traits\Repository\HasScrapeDateTrait;
use App\Infrastructure\Traits\Repository\HasTrackerTrait;

class UserRepository extends ResourceRepository
{
    use HasTrackerTrait, HasScrapeDateTrait;

    public function __construct(
        protected readonly User $model,
    ) {}

    protected static function getArgs(): array {
        return [new User()];
    }
}
