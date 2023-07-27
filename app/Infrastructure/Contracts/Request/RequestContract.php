<?php

namespace App\Infrastructure\Contracts\Request;

/** @method array validated() */
interface RequestContract
{
    public function authorize(): bool;

    public function rules(): array;
}
