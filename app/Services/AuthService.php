<?php

namespace App\Services;

use App\Models\User;
use App\Models\RoleUser;
use App\Services\RoleUserService;
use App\Repositories\AuthRepository;
use App\Repositories\RoleUserRepository;

class AuthService
{
    protected $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function register(array $payload, bool $isAdmin = false): User
    {
        try{
            $user = $this->authRepository->create($payload);
            if(!$user)
            {
                throw new \Exception('Failed to create user');
            }

            $roleUserService = new RoleUserService(new RoleUserRepository(new RoleUser()));
            $roleUser = null;
            if($isAdmin)
            {
                $roleUser = $roleUserService->assignRole($user->id, 1);
                if(!$roleUser)
                {
                    throw new \Exception('Failed to assign admin role');
                }
                return $user;
            }

            $roleUser = $roleUserService->assignRole($user->id, 2);
            if(!$roleUser)
            {
                throw new \Exception('Failed to assign client role');
            }

            return $user;
        }catch(\Exception $e){
            throw new \Exception('Failed to register user: ' . $e->getMessage());
        }
    }
}