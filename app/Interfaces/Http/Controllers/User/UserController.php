<?php

namespace App\Interfaces\Http\Controllers\User;

use App\Domain\Models\User\UserRepository;
use App\Infrastructure\Base\BaseController;
use App\Infrastructure\Base\ResourceController;
use Illuminate\Http\Request;

class UserController extends ResourceController
{
    public function __construct(
        protected readonly UserRepository $repository,
    ) {}
}
