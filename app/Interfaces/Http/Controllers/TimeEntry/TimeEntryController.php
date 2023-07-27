<?php

namespace App\Interfaces\Http\Controllers\TimeEntry;

use App\Domain\Models\TimeEntry\TimeEntryRepository;
use App\Infrastructure\Base\BaseController;
use App\Infrastructure\Base\ResourceController;
use App\Infrastructure\Requests\TimeEntry\TimeEntryCreateRequest;
use App\Infrastructure\Requests\TimeEntry\TimeEntryUpdateRequest;

class TimeEntryController extends ResourceController
{
    public function __construct(
        protected readonly TimeEntryRepository $repository,
    ) {}

    public function getCreateRequest(): string {
        return TimeEntryCreateRequest::class;
    }

    public function getUpdateRequest(): string {
        return TimeEntryUpdateRequest::class;
    }
}
