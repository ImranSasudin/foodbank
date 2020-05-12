<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $roles)
    {
        // if (!Auth::guard('employee')->check()){ // I included this check because you have it, but it really should be part of your 'auth' middleware, most likely added as part of a route group.
        //     return redirect()->route('users.loginForm');
        // }
        // else if (!Auth::guard('user')->check()){
        //      return redirect()->route('users.loginForm');
        // }

        if($roles == 'Employee'){

            if(Auth::guard('employee')->check()) {
                return $next($request);
            }
            else{
                return redirect()->route('users.loginForm');
            }

        }

        if($roles == 'Admin' || $roles == 'Staff'){
            if(isset(Auth::guard('employee')->user()->role))
                $role = Auth::guard('employee')->user()->role;
            else
                return redirect()->route('users.loginForm');

            if($role == $roles) {
                return $next($request);
            }
            else if(Auth::guard('employee')->check()) {
                return redirect()->route('employees.dashboard');
            }
            else{
                return redirect()->route('users.loginForm');
            }

        }

        if($roles == 'User'){
            if(!Auth::guard('user')->check()){
                return redirect()->route('users.loginForm');
            }
            else{
                return $next($request);
            }

        }
    }
}
