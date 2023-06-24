<?php

namespace App\Infrastructure\Base;

abstract class BaseRepository
{
//    protected readonly BaseModel $model;

    public function getModel(): BaseModel {
        return $this->model;
    }
}
