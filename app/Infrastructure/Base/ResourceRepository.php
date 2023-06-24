<?php
namespace App\Infrastructure\Base;

use App\Infrastructure\Interfaces\ResourceRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

abstract class ResourceRepository extends BaseRepository implements ResourceRepositoryInterface
{
    protected function getModelQueryBuilder() {
        return $this->model;
    }

    public function index(): Collection {
        return $this->getModelQueryBuilder()->all();
    }
}
