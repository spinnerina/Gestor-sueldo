<?php

namespace App\Services;

use App\Models\RoleUser;
use App\Models\Companies;
use App\Services\RoleUserService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Cache;
use App\Repositories\RoleUserRepository;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\Contracts\CompaniesRepositoryInterface;

class CompaniesService extends BaseService
{
    protected $companiesRepository;
    protected $tll;

    public function __construct(CompaniesRepositoryInterface $companiesRepository, int $minutes = 10)
    {
        $this->companiesRepository = $companiesRepository;
        $this->tll = now()->addMinutes($minutes);
    }

    /**
     * Get all companies
     */
    public function getAllCompanies(Array $columns = ['*'], Array $relations = ['user']): Collection
    {
        if (Gate::allows('viewAny', Companies::class)) {
            return Cache::store('redis')->tags(['companies'])->remember('companies.all', $this->tll, function() use ($columns, $relations){
                return $this->companiesRepository->all(['status' => 1], $columns, $relations);
            });
        } else {
            $user = auth()->user();
            $where = [
                'status' => 1,
                'created_by_user_id' => $user->id
            ];
            return Cache::store('redis')->tags(['companies'])->remember('companies.all', $this->tll, function() use ($columns, $relations, $where){
                return $this->companiesRepository->all($where, $columns, $relations);
            });
        }
    }

    /**
     * Get company by id
     */
    public function getCompanyById(int $companyId): ?Companies
    {
        return Cache::tags(['companies'])->remember("companies.find.{$companyId}", $this->tll, function() use($companyId){
            return $this->companiesRepository->find($companyId);
        });
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
            Cache::tags(['companies'])->forget('companies.all');
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
            Cache::tags(['companies'])->forget("companies.find.{$companyId}");
            Cache::tags(['companies'])->forget('companies.all');
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
            Cache::tags(['companies'])->forget('companies.all');
            return $deleted;
        }catch(\Exception $e){
            DB::rollBack();
            throw new \Exception('Error deleting company: ' . $e->getMessage());
        }
    }
}