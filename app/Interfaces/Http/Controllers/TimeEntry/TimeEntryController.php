<?php

namespace App\Interfaces\Http\Controllers\TimeEntry;

use App\Domain\Models\TimeEntry\TimeEntryRepository;
use App\Infrastructure\Base\BaseController;
use App\Infrastructure\Base\ResourceController;

class TimeEntryController extends ResourceController
{
    public function __construct(
        protected readonly TimeEntryRepository $repository,
    ) {}
}
