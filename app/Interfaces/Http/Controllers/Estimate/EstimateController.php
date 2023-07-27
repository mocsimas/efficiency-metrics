<?php

namespace App\Interfaces\Http\Controllers\Estimate;

use App\Domain\Models\Estimate\EstimateRepository;
use App\Domain\Models\Task\Task;
use App\Infrastructure\Base\BaseController;
use App\Infrastructure\Base\ResourceController;
use App\Infrastructure\Contracts\Request\CreateRequestContract;
use App\Infrastructure\Contracts\Request\UpdateRequestContract;
use App\Infrastructure\Requests\Estimate\EstimateCreateRequest;
use App\Infrastructure\Requests\Estimate\EstimateUpdateRequest;
use Illuminate\Http\Request;

class EstimateController extends ResourceController
{
    public function __construct(
        protected readonly EstimateRepository $repository,
    ) {}

    public function getCreateRequest(): string {
        return EstimateCreateRequest::class;
    }

    public function getUpdateRequest(): string {
        return EstimateUpdateRequest::class;
    }
}
