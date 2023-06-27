<?php

namespace App\Infrastructure\Base;

abstract class BaseRepository
{
    protected static function getArgs(): array {
        return [];
    }

    protected function getModelQueryBuilder() {
        return $this->model;
    }

    public function getModel(): BaseModel {
        return $this->model;
    }

    /**
     * Create instance of current repository and store it in singleton
     *
     * @return static
     */
    public static function getInstance() {
        return new (static::class)(...static::getArgs());
    }
}
