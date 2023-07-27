<?php

namespace App\Infrastructure\Contracts;

use App\Infrastructure\Base\BaseModel;
use Illuminate\Database\Eloquent\Collection;

interface ResourceRepositoryContract
{
    public function index(): Collection;

    public function find(string $key, $value): ?BaseModel;

    public function create(array $values): ?BaseModel;

//    public function update(): ?BaseModel;
}
