<?php

namespace App\Interfaces\Http\Controllers\User;

use App\Domain\Models\User\UserRepository;
use App\Infrastructure\Base\BaseController;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    public function __construct(
        private readonly UserRepository $repository,
    ) {}

    public function index() {
        try {
            $workspaces = $this->repository->index();

            return $this->response($workspaces);
        }catch (\Exception $exception) {
            return $this->error($exception->getMessage(), [], $exception->getCode());
        }
    }
}
