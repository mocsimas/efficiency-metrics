<?php

namespace App\Interfaces\Http\Controllers\Estimate;

use App\Domain\Models\Estimate\EstimateRepository;
use App\Domain\Models\Task\Task;
use App\Infrastructure\Base\BaseController;
use App\Infrastructure\Base\ResourceController;
use Illuminate\Http\Request;

class EstimateController extends ResourceController
{
    public function __construct(
        protected readonly EstimateRepository $repository,
    ) {}

    public function validator(Request $request, string $type) {
        $taskNamespace = Task::class;

        $createRules = [
            'task_uuid' => "required|exists:$taskNamespace,uuid",
            'from' => 'required|integer|gte:0',
            'to' => 'required|integer|gte:from'
        ];

        return match ($type) {
            'create' => $request->validate($createRules),
            'update' => $request->validate(array_merge($createRules, ['uuid' => 'required|uuid'])),
        };
    }
}
