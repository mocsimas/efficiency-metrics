<?php

namespace App\Infrastructure\Requests\Estimate;

use App\Infrastructure\Contracts\Request\CreateRequestContract;
use Illuminate\Foundation\Http\FormRequest;

class EstimateCreateRequest extends FormRequest implements CreateRequestContract
{
    use SharedEstimateRulesTrait;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return $this->getSharedRules();
    }
}
