<?php

namespace App\Domain\Services;

use App\Domain\Models\User\User;
use App\Domain\Models\User\UserRepository;
use App\Infrastructure\Enums\TrackerEnum;
use Illuminate\Support\Collection;

class UserService
{
    private readonly UserRepository $repository;

    public function __construct() {
        $this->repository = UserRepository::getInstance();
    }

    private function usersGenerator(Collection $users): \Generator {
        foreach($users as $user)
            yield (array) $user;
    }

    public function createUsers(TrackerEnum $trackerEnum, Collection $users, \DateTime $scrapeDate) {
        $service = $trackerEnum->getService();

        foreach($this->usersGenerator($users) as $user)
            $this->repository->updateOrCreate(
                'tracker_user_id',
                $user[$trackerEnum->getTrackerIdKey(User::class)],
                $service->mapUser($user, $scrapeDate),
            );

        $this->repository->deleteEarlierScraped($scrapeDate);

        // TODO: add notification informing that users scrape has been finished
    }
}
