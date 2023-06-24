<?php

namespace App\Infrastructure\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface ResourceRepositoryInterface
{
    public function index(): Collection;
}
