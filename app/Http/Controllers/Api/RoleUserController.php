<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RoleUser;
use Illuminate\Http\Request;
use App\Services\RoleUserService;
use Inertia\Inertia;

class RoleUserController extends Controller
{
    protected $roleUserService;

    public function __construct(RoleUserService $roleUserService)
    {
        $this->roleUserService = $roleUserService;
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index(): \Inertia\Response
    {
        $roleUser = $this->roleUserService->getRoleUser();
        return Inertia::render('roleUser/Index', [
            'roleUser' => $roleUser
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(RoleUser $roleUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RoleUser $roleUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $user_id, int $role_id): \Inertia\Response|JsonResponse
    {
        try{
            $this->roleUserService->unassignRole($user_id, $role_id);
            if(request()->expectsJson()){
                return response()->json([
                    'message' => 'Role user deleted successfully',
                ], 200);
            }
            return Inertia::render('roleUser/Index');
        }catch(\Exception $e){
            if(request()->expectsJson()){
                return response()->json([
                    'message' => 'Error deleting role user',
                    'error' => $e->getMessage(),
                ], 500);
            }
            return Inertia::render('roleUser/Index');
        }
    }
}
