<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class role_has_permissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permission)
    {
        if(Auth::user()){
            $role = \App\UserRole::findOrFail(Auth::user()->role_id);
            if($role->hasPermissionTo($permission)){
                return $next($request);
            }else{
                abort('403');
                // return response()->json(["data" => ["error" => "Sorry you do not have permission to perform this task."]], 403);
            }
        }else{
            //user not loged in.
            return redirect('auth/login');
            //abort('401');
        }
    }
}
