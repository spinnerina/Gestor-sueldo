<?php

namespace App\Services;

use App\Repositories\Contracts\CompaniesRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Companies;
use Illuminate\Support\Facades\DB;

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
        if($user->role_id == 1){
            return $this->companiesRepository->all($columns, $relations);
        }else{
            return $this->companiesRepository->all($columns, $relations)->where('created_by_user_id', $user->id);
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