<?php

namespace App\Infrastructure\Interfaces;

use App\Infrastructure\Base\BaseModel;
use Illuminate\Database\Eloquent\Collection;

interface ResourceRepositoryInterface
{
    public function index(): Collection;

    public function find(string $key, $value): ?BaseModel;

    public function create(array $values): ?BaseModel;

//    public function update(): ?BaseModel;
}
