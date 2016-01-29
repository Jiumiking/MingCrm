<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Route;

class Permission
{
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //首先验证用户是否登入
        if ($this->auth->guest()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('login');
            }
        }

        //检查是否具有权限
        if (!$this->auth->user()->isSuperAdmin()
            && !$this->auth->user()->hasPermission(Route::currentrouteName())) {
            return view('errors.401',['permission'=>Route::currentrouteName()]);
        }
        return $next($request);
    }
}
