<?php

namespace App\Infrastructure\Traits\Repository;


trait HasImportDateTrait
{
    public function deleteEarlierImported(\DateTime $importDate) {
        return $this->getModelQueryBuilder()->where([
            ['import_date', '<', $importDate->format('Y-m-d H:i:s')],
        ])->delete();
    }
}
