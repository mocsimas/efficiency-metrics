<?php

namespace App\Infrastructure\Traits\Repository;


trait HasImportDateTrait
{
//    public function findByTracker(TrackerEnum $trackerEnum): Collection {
//        return $this->getModelQueryBuilder()->where([
//            ['tracker', '=', $trackerEnum->value]
//        ])->get();
//    }

    public function deleteEarlierImported(\DateTime $importDate) {
        return $this->getModelQueryBuilder()->where([
            ['import_date', '<', $importDate->format('Y-m-d H:i:s')],
        ])->delete();
    }
}
