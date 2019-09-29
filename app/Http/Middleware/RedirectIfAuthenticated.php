<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

use App\User;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if ($guard=="admin" && Auth::guard($guard)->check()) {
            return redirect('/admin/dashboard');
        }
        if (Auth::guard($guard)->check()) {
            // return redirect('/dashboard');
            if (User::find(1)->roleRedirect('Admin')) {
              return redirect()->route('admin.dashboard');
            }
            elseif(User::find(1)->roleRedirect('Author')){
              return redirect()->route('author.dashboard');
            }
            elseif(User::find(1)->roleRedirect('Worshippers')){
              return redirect()->route('worshipper.dashboard');
            }
            else{
              return redirect()->route('user.dashboard');
            }
        }
        return $next($request);
    }
}
