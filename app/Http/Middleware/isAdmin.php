<?php

namespace App\Http\Middleware;

use App\Models\Role;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Providers\RouteServiceProvider;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $role_id = $request->user()->role;
        $user_role = Role::find($role_id)->role;
        

        if (!$request->user() || ($user_role === 'admin') != '1') {

            return redirect(RouteServiceProvider::HOME);
        }
        return $next($request);
    }
}
