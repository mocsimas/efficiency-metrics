<?php
namespace App\Infrastructure\Base;

use App\Infrastructure\Interfaces\ResourceRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

abstract class ResourceRepository extends BaseRepository implements ResourceRepositoryInterface
{
    public function index(): Collection {
        return $this->getModelQueryBuilder()->all();
    }

    public function find(string $key, mixed $value): ?BaseModel {
        return $this->getModelQueryBuilder()->where($key, $value)->first();
    }

    public function create(array $values): ?BaseModel {
        return $this->getModelQueryBuilder()->create($values);
    }

    public function update(array $data, ?string $key = null): BaseModel {
        if($key === null)
            $key = $this->model->getKeyName();

        if(!in_array($key, $this->model->getFillable()))
            throw new \Exception('Invalid key provided.');

        $model = $this->find($key, $data[$key]);

        if(!$model)
            throw new ModelNotFoundException('Model was not found.');

        $updated = $model->update($data);

        if(!$updated)
            throw new \Exception('Failed to update model.');

        return $model;
    }

    public function updateOrCreate(string $key, mixed $value, array $data): BaseModel {
        if(!$this->find($key, $value))
            return $this->create($data);

        return $this->update($data, $key);
    }
}
