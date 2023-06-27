<?php

namespace App\Interfaces\Http\Controllers\User;

use App\Domain\Models\User\UserRepository;
use App\Infrastructure\Base\BaseController;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    public function __construct(
        protected readonly UserRepository $repository,
    ) {}
}
