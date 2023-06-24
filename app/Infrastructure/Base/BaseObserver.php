<?php

namespace App\Infrastructure\Base;

abstract class BaseObserver
{
    public function created(BaseModel $model) {
        //
    }

    public function creating(BaseModel $model) {
        return $model;
    }

    public function updated(BaseModel $model) {
        //
    }

    public function updating(BaseModel $model) {
        return $model;
    }
}
