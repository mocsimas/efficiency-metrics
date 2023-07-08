<?php

namespace App\Domain\Services\Model;

use App\Domain\Models\User\User;
use App\Domain\Models\User\UserRepository;
use App\Domain\Services\Abstract\ModelService;
use App\Infrastructure\Enums\TrackerEnum;
use Illuminate\Support\Collection;

class UserService extends ModelService
{
    private readonly UserRepository $repository;

    public function __construct() {
        $this->repository = UserRepository::getInstance();
    }

    public function create(TrackerEnum $trackerEnum, Collection $collection, \DateTime $importDate): void {
        $service = $trackerEnum->getService();

        foreach($this->generator($collection) as $user)
            $this->repository->updateOrCreate(
                'tracker_id',
                $user[$trackerEnum->getTrackerIdKey(User::class)],
                $service->mapUser($user, $importDate),
            );

        $this->repository->deleteEarlierImported($importDate);
    }
}
