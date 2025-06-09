<?php

namespace App\Services;

use App\Repositories\Contracts\JobsRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;


class JobsService extends BaseService
{
    protected $jobsRepository;

    public function __construct(JobsRepositoryInterface $jobsRepository)
    {
        $this->jobsRepository = $jobsRepository;
    }

    public function getAllJobs(): Collection
    {
        $jobs = $this->jobsRepository->all();
        if (!$jobs) {
            throw new \Exception('Jobs not found');
        }
        return $jobs;
    }

    public function getJobById(int $jobId): ?Jobs
    {
        $job = $this->jobsRepository->find($jobId);
        if (!$job) {
            throw new \Exception('Job not found');
        }
        return $job;
    }

    public function createJob(array $payload): Jobs
    {
        DB::beginTransaction();
        try{
            $job = $this->jobsRepository->create($payload);
            DB::commit();
            return $job;
        }catch(\Exception $e){
            DB::rollBack();
            throw new \Exception('Error creating job: ' . $e->getMessage());
        }
    }

    public function updateJob(int $jobId, array $payload): Jobs
    {
        DB::beginTransaction();
        try{
            $job = $this->jobsRepository->update($jobId, $payload);
            DB::commit();
            return $job;
        }catch(\Exception $e){
            DB::rollBack();
            throw new \Exception('Error updating job: ' . $e->getMessage());
        }
    }

    public function deleteJob(int $jobId): bool
    {
        return $this->jobsRepository->delete($jobId);
    }
}