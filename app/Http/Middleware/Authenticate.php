<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Closure;

class Authenticate extends Controller
{
    public function handle(Request $request, Closure $next)
    {
//        $user = Session::get('SESSION_ACCOUNT');
//        if (!isset($user)) {
//            return redirect('login');
//        }
        return $next($request);
    }
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return redirect('/login');
        }
    }
}
