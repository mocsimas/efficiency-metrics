<?php

namespace App\Domain\Models\User;

use App\Infrastructure\Base\ResourceRepository;
use App\Infrastructure\Traits\Repository\HasImportDateTrait;
use App\Infrastructure\Traits\Repository\HasTrackerTrait;

class UserRepository extends ResourceRepository
{
    use HasTrackerTrait, HasImportDateTrait;

    public function __construct(
        protected readonly User $model,
    ) {}

    protected static function getArgs(): array {
        return [new User()];
    }
}
