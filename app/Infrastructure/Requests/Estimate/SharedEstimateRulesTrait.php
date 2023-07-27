<?php

namespace App\Infrastructure\Requests\Estimate;

use App\Domain\Models\Task\Task;

trait SharedEstimateRulesTrait
{
    protected function getSharedRules(): array {
        $taskNamespace = Task::class;

        return [
            'task_uuid' => "required|exists:$taskNamespace,uuid",
            'from' => 'required|integer|gte:0',
            'to' => 'required|integer|gte:from',
        ];
    }
}
