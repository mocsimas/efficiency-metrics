<?php

namespace App\Domain\Services;

use App\Infrastructure\Interfaces\TrackerServiceInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class ClockifyService extends TrackerService implements TrackerServiceInterface
{
    private $http;

    public function __construct() {
        $this->http = Http::clockify();
    }

    public function getWorkspaces(): Collection {
        $response = $this->http->get('/v1/workspaces');

        if(!$response->successful())
            throw new \Exception('Failed to fetch workspaces.');

        return collect($response->json());
    }
}
