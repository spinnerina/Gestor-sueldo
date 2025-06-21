<?php

namespace App\Services;

use App\Repositories\Contracts\RoleUserRepositoryInterface;
use App\Models\RoleUser;
use Illuminate\Database\Eloquent\Collection;

class RoleUserService extends BaseService
{
    protected $roleUserRepository;

    public function __construct(RoleUserRepositoryInterface $roleUserRepository)
    {
        $this->roleUserRepository = $roleUserRepository;
    }

    public function getRoleUser(): Collection
    {
        $relations = ['user', 'role'];
        return $this->roleUserRepository->all([], ['*'], $relations);
    }

    public function findRoleUser(array $where = []): ?RoleUser
    {
        return $this->roleUserRepository->findBy($where, ['user_id', 'role_id'], ['role']);
    }

    public function assignRole(int $userId, int $roleId): ?RoleUser
    {
        $object = [
            'user_id' => $userId,
            'role_id' => $roleId
        ];
        $roleUser = $this->roleUserRepository->findBy($object);
        if($roleUser)
        {
            return $roleUser;
        }
        
        return $this->roleUserRepository->create($object);
    }

    public function unassignRole(int $userId, int $roleId): ?bool
    {
        $object = [
            'user_id' => $userId,
            'role_id' => $roleId
        ];
        $roleUser = $this->roleUserRepository->findBy($object);
        if(!$roleUser)
        {
            return true;
        }
        return $this->roleUserRepository->delete($roleUser->id);
    }
}