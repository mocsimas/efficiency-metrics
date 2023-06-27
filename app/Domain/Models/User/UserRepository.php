<?php

namespace App\Domain\Models\User;

use App\Infrastructure\Base\ResourceRepository;

class UserRepository extends ResourceRepository
{
    public function __construct(
        protected readonly User $model,
    ) {}
}
