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

    public function find(string $key, mixed $value): ?BaseModel {
        return $this->getModelQueryBuilder()->where($key, $value)->first();
    }

    public function create(array $values): ?BaseModel {
        return $this->getModelQueryBuilder()->create($values);
    }
}
