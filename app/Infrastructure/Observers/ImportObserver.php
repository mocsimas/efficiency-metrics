<?php

namespace App\Infrastructure\Observers;

use App\Infrastructure\Base\BaseModel;
use App\Infrastructure\Base\BaseObserver;
use App\Infrastructure\Enums\ImportTypeEnum;

class ImportObserver extends BaseObserver
{
    public function creating(BaseModel $model) {
        if(!$model->tracker && $model->type !== ImportTypeEnum::ALL)
            throw new \Exception("Invalid tracker for \"{$model->type}\" import.");

        return $model;
    }
}
