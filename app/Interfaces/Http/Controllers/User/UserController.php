<?php

namespace App\Interfaces\Http\Controllers\User;

use App\Domain\Models\User\UserRepository;
use App\Infrastructure\Base\BaseController;
use App\Infrastructure\Base\ResourceController;
use App\Infrastructure\Requests\User\UserCreateRequest;
use App\Infrastructure\Requests\User\UserUpdateRequest;
use Illuminate\Http\Request;

class UserController extends ResourceController
{
    public function __construct(
        protected readonly UserRepository $repository,
    ) {}

    public function getCreateRequest(): string {
        return UserCreateRequest::class;
    }

    public function getUpdateRequest(): string {
        return UserUpdateRequest::class;
    }
}
