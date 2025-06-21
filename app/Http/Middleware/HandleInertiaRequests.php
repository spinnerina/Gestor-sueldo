<?php

namespace App\Http\Middleware;

use Inertia\Middleware;
use App\Models\RoleUser;
use Tighten\Ziggy\Ziggy;
use Illuminate\Http\Request;
use App\Services\RoleUserService;
use Illuminate\Foundation\Inspiring;

class HandleInertiaRequests extends Middleware
{
    protected RoleUserService $roleUserService;
    protected ?RoleUser $roleUser = null;

    public function __construct(RoleUserService $roleUserService)
    {
        $this->roleUserService = $roleUserService;
    }
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        [$message, $author] = str(Inspiring::quotes()->random())->explode('-');
        // dd($request->user());
        if($request->user())
        {
            $this->roleUser = $this->roleUserService->findRoleUser(['user_id' => $request->user()->id]);
        }
        return [
            ...parent::share($request),
            'name' => config('app.name'),
            'quote' => ['message' => trim($message), 'author' => trim($author)],
            'auth' => [
                'user' => $request->user(),
                'role_user' => $this->roleUser,
            ],
            // 'ziggy' => [
            //     ...(new Ziggy)->toArray(),
            //     'location' => $request->url(),
            // ],
            'sidebarOpen' => ! $request->hasCookie('sidebar_state') || $request->cookie('sidebar_state') === 'true',
        ];
    }
}
