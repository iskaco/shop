<?php

namespace App\Http\Middleware;

use App\Http\Resources\AdminResource;
use App\Http\Resources\CustomerResource;
use Illuminate\Http\Request;
use Inertia\Middleware;
use Tighten\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $activites = [];
        if ($request->user('admin')) {
            $activites = $request->user('admin')->getPermissionsViaRoles()
                ->where('activity.is_menu', true)
                ->where('activity.is_active', true);
        }

        return [
            ...parent::share($request),
            'auth' => [
                'user' => $request->user(),
                'customer' => auth('customer')?->user(), // CustomerResource::make(auth('customer')?->user()),
                'activities' => $activites,
                ...($request->user('admin') ? ['admin' => auth('admin')?->user()/* AdminResource::make(auth('admin')?->user()) */] : []),
            ],
            'ziggy' => fn () => [
                ...(new Ziggy)->toArray(),
                'location' => $request->url(),
            ],
            'flash' => fn () => [
                'toasts' => $request->session()->get('toasts'),
            ],
            'locale' => app()->getLocale(),
        ];
    }
}
