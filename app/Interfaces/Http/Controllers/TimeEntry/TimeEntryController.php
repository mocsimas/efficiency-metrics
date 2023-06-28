<?php

namespace App\Interfaces\Http\Controllers\TimeEntry;

use App\Domain\Models\TimeEntry\TimeEntryRepository;
use App\Infrastructure\Base\BaseController;

class TimeEntryController extends BaseController
{
    public function __construct(
        protected readonly TimeEntryRepository $repository,
    ) {}
}
