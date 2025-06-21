<?php

namespace App\Repositories\Contracts;

use App\Models\User;

interface AuthRepositoryInterface
{
    public function create(array $user): User;
    public function attemptLogin(array $credentials, bool $remember = false): bool;
    public function logout(): void;
}