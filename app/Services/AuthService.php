<?php

namespace App\Services;

use App\Models\User;
use App\Models\RoleUser;
use Illuminate\Http\Request;
use App\Services\RoleUserService;
use App\Repositories\AuthRepository;
use App\Repositories\RoleUserRepository;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use App\Http\Requests\Auth\LoginRequest;

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

    public function login(LoginRequest $request): void
    {
        $this->ensureIsNotRateLimited($request);

        $credentials = $request->only('email', 'password');
        $remember = $request->boolean('remember');

        if (! $this->authRepository->attemptLogin($credentials, $remember)) {
            RateLimiter::hit($this->throttleKey($request));

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey($request));
        
        $request->session()->regenerate();
    }

    private function ensureIsNotRateLimited(LoginRequest $request): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey($request), 5)) {
            return;
        }

        $seconds = RateLimiter::availableIn($this->throttleKey($request));

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    private function throttleKey(Request $request): string
    {
        return Str::transliterate(Str::lower($request->input('email')).'|'.$request->ip());
    }

    public function logout(Request $request): void
    {
        $this->authRepository->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
    }
}