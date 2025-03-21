<?php

namespace App\Http\Middleware;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
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
        $user = Auth::check() ? User::find(Auth::id()) : null;
        $accessToken = $user ? $user->createToken('web')->plainTextToken : null;

        return array_merge(parent::share($request), [
            'g_client_id' => env('GOOGLE_CLIENT_ID'),
            'app.debug' => config('app.debug'),
            'app.name' => config('app.name'),
            'apiUrl' => env('API_URL', 'http://localhost:8000/api'),
            'user' => $user ? $user->only('id', 'name', 'email') : null,
            'accessToken' => $accessToken,
        ]);
    }
}
