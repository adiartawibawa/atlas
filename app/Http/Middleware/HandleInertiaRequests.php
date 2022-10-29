<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;

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
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request)
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request)
    {
        return array_merge(parent::share($request), [
            'ziggy' => function () use ($request) {
                return array_merge((new Ziggy)->toArray(), [
                    'location' => $request->url(),
                ]);
            },

            'user' => function () use ($request) {
                if (!$request->user()) {
                    return;
                }

                return array_merge(
                    $request->user()->only('id', 'name', 'email'),
                    array_filter([
                        'roles' => $request->user() ? $request->user()->roles()->pluck('name') : null,
                        'permissions' => $request->user() ? $request->user()->getAllPermissions()->pluck('name') : null,
                    ])
                );
            },


        ]);
    }
}
