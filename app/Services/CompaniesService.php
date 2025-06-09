<?php

namespace App\Services;

use App\Models\RoleUser;
use App\Models\Companies;
use App\Services\RoleUserService;
use Illuminate\Support\Facades\DB;
use App\Repositories\RoleUserRepository;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\Contracts\CompaniesRepositoryInterface;

class CompaniesService extends BaseService
{
    protected $companiesRepository;

    public function __construct(CompaniesRepositoryInterface $companiesRepository)
    {
        $this->companiesRepository = $companiesRepository;
    }

    /**
     * Get all companies
     */
    public function getAllCompanies(): Collection
    {
        $relations = ['user'];
        $columns = ['*'];
        $user = auth()->user();
        $where = ['status' => 1];
        $roleUserService = new RoleUserService(new RoleUserRepository(new RoleUser()));
        $roleUser = $roleUserService->findRoleUser(['user_id' => $user->id]);
        if($roleUser->role_id == 1)
        {
            return $this->companiesRepository->all($where, $columns, $relations);
        }
        else
        {
            $where['created_by_user_id'] = $user->id;
            return $this->companiesRepository->all($where, $columns, $relations);
        }
    }

    /**
     * Get company by id
     */
    public function getCompanyById(int $companyId): ?Companies
    {
        return $this->companiesRepository->find($companyId);
    }

    /**
     * Create a new company
     */
    public function createCompany(array $payload): Companies
    {
        DB::beginTransaction();
        try{
            $user = auth()->user() ? auth()->user()->id : null;
            $payload['created_by_user_id'] = $user;
            $company = $this->companiesRepository->create($payload);
            DB::commit();
            return $company;
        }catch(\Exception $e){
            DB::rollBack();
            throw new \Exception('Error creating company: ' . $e->getMessage());
        }
    }

    /**
     * Update a company
     */
    public function updateCompany(int $companyId, array $payload): Companies
    {
        $company = $this->companiesRepository->find($companyId);
        if(!$company){
            throw new \Exception('Company not found');
        }

        DB::beginTransaction();
        try{
            $updatedCompany = $this->companiesRepository->update($companyId, $payload);
            DB::commit();
            return $updatedCompany;
        }catch(\Exception $e){
            DB::rollBack();
            throw new \Exception('Error updating company: ' . $e->getMessage());
        }
    }

    
    /**
     * Delete a company
     */
    public function deleteCompany(int $companyId): bool
    {
        $company = $this->companiesRepository->find($companyId);
        if(!$company){
            throw new \Exception('Company not found');
        }

        DB::beginTransaction();
        try{
            $deleted = $this->companiesRepository->delete($companyId);
            DB::commit();
            return $deleted;
        }catch(\Exception $e){
            DB::rollBack();
            throw new \Exception('Error deleting company: ' . $e->getMessage());
        }
    }
}