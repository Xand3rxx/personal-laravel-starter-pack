<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Role;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Cache;

class VerifyUserUrl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Cache the roles available in the `roles` table
        $roles = Cache::rememberForever('roles', function () {
            return Role::all()->mapWithKeys(function ($role) {
                return [$role['url'] => $role['name']];
            })->toArray();
        });

        // Check if Request Segment(1) exist in roles table
        if (!array_key_exists($request->segment(1), $roles)) {
            return abort(404);
        }

        // Check if Request Segment(1) is equal to Authenticated User url
        if (strcmp($request->segment(1), auth()->user()->role->url)) {
            return abort(403, Str::words("Sorry! You don't have access to this page, goto " . URL::to("/") . "/" . $request->user()->role->url . " instead. Thanks."));
        }

        return $next($request);
    }
}
