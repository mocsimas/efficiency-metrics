<?php

namespace App\Infrastructure\Requests\Metric;

use Illuminate\Foundation\Http\FormRequest;

class MetricWorkspaceDurationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'year' => 'required|date_format:Y',
            'month' => 'required|date_format:n',
        ];
    }
}
