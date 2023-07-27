<?php

namespace App\Infrastructure\Requests\Workspace;

use Illuminate\Foundation\Http\FormRequest;

class WorkspaceCreateRequest extends FormRequest
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
