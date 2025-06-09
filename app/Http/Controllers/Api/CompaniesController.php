<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Companies;
use App\Http\Requests\CompaniesRequest;
use App\Services\CompaniesService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CompaniesController extends Controller
{
    protected $companyService;

    public function __construct(CompaniesService $companyService)
    {
        $this->companyService = $companyService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): \Inertia\Response
    {
        $companies = $this->companyService->getAllCompanies();
        return Inertia::render('companies/Index', [
            'companies' => $companies,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompaniesRequest $request): \Inertia\Response|JsonResponse
    {
        try{
            $company = $this->companyService->createCompany($request->validated());
            if(request()->expectsJson()){
                return response()->json([
                    'message' =>  'Company created successfully',
                    'company' => $company,
                ], 201);
            }
            return Inertia::render('companies/Create', ['company' => $company]);
        }catch(\Exception $e){
            if(request()->expectsJson()){
                return response()->json([
                    'message' => 'Error creating company',
                    'error' => $e->getMessage(),
                ], 500);
            }
            return back()->withErrors(['error' => 'Error creating company: ' . $e->getMessage()]);
        }
    }

    public function create(): \Inertia\Response|JsonResponse
    {
        return Inertia::render('companies/Create');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): \Inertia\Response|JsonResponse
    {
        $company = $this->companyService->getCompanyById($id);
        if(!$company){
            if(request()->expectsJson()){
                return response()->json([
                    'message' => 'Company not found',
                ], 404);
            }
            abort(404, 'Company not found');
        }

        return Inertia::render('companies/Show', [
            'company' => $company,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompaniesRequest $request, int $id): \Inertia\Response|JsonResponse
    {
        try{
            $company = $this->companyService->updateCompany($id, $request->validated());
            if(request()->expectsJson()){
                return response()->json([
                    'message' => 'Company updated successfully',
                    'company' => $company,
                ], 200);
            }
            return Inertia::render('companies/Edit', ['company' => $company]);
        }catch(\Exception $e){
            if(request()->expectsJson()){
                return response()->json([
                    'message' => 'Error updating company',
                    'error' => $e->getMessage(),
                ], 500);
            }
            return back()->withErrors(['error' => 'Error updating company: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): \Inertia\Response|JsonResponse
    {
        try{
            $this->companyService->deleteCompany($id);
            if(request()->expectsJson()){
                return response()->json([
                    'message' => 'Company deleted successfully',
                ], 200);
            }
            return Inertia::render('companies/Index');
        }catch(\Exception $e){
            if(request()->expectsJson()){
                return response()->json([
                    'message' => 'Error deleting company',
                    'error' => $e->getMessage(),
                ], 500);
            }
            return Inertia::render('companies/Index');
        }
    }

    public function edit(int $id): \Inertia\Response|JsonResponse
    {
        $company = $this->companyService->getCompanyById($id);
        if(!$company){
            if(request()->expectsJson()){
                return response()->json([
                    'message' => 'Company not found',
                ], 404);
            }
            abort(404, 'Company not found');
        }
        return Inertia::render('companies/Edit', ['company' => $company]);
    }
}
