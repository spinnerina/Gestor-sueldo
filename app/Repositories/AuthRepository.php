<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;
use App\Repositories\Contracts\AuthRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class AuthRepository extends BaseRepository implements AuthRepositoryInterface
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function create(array $user): User
    {
        return parent::create($user);
    }

    public function attemptLogin(array $credentials, bool $remember = false): bool
    {
        return Auth::attempt($credentials, $remember);
    }

    public function logout(): void
    {
        Auth::guard('web')->logout();
    }
}