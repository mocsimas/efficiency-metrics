<?php

namespace App\Infrastructure\Requests\Estimate;

use App\Infrastructure\Contracts\Request\UpdateRequestContract;
use Illuminate\Foundation\Http\FormRequest;

class EstimateUpdateRequest extends FormRequest implements UpdateRequestContract
{
    use SharedEstimateRulesTrait;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return array_merge($this->getSharedRules(), [
            'uuid' => 'required|uuid',
        ]);
    }
}
