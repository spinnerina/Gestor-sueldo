<?php

namespace App\Http\Controllers\Auth;

use Inertia\Inertia;
use Inertia\Response;
use App\Services\AuthService;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\RegisterRequest;
use Illuminate\Auth\Events\Registered;

class RegisteredUserController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Show the registration page.
     */
    public function create(): Response
    {
        return Inertia::render('auth/Register');
    }

    /**
     * Handle an incoming registration request.
     */
    public function store(RegisterRequest $request): RedirectResponse
    {
        try{
            $user = $this->authService->register($request->validated());
            if(!$user)
            {
                return back()->withErrors(['error' => 'Failed to create user']);
            }
            event(new Registered($user));
            $this->authService->login($request);
            return redirect()->route('dashboard', absolute: false);
        }catch(\Exception $e){
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
