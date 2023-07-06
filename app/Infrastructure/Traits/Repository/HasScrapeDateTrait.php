<?php

namespace App\Infrastructure\Traits\Repository;


trait HasScrapeDateTrait
{
//    public function findByTracker(TrackerEnum $trackerEnum): Collection {
//        return $this->getModelQueryBuilder()->where([
//            ['tracker', '=', $trackerEnum->value]
//        ])->get();
//    }

    public function deleteEarlierScraped(\DateTime $scrapeDate) {
        return $this->getModelQueryBuilder()->where([
            ['scrape_date', '<', $scrapeDate->format('Y-m-d H:i:s')],
        ])->delete();
    }
}
