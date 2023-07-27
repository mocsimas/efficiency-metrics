<?php

namespace App\Infrastructure\Requests\TimeEntry;

use Illuminate\Foundation\Http\FormRequest;

class TimeEntryCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return false;
    }

    public function rules(): array
    {
        return [
            //
        ];
    }
}
