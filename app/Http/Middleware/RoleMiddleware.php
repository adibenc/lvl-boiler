<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
// use Spatie\Permission\Exceptions\UnauthorizedException;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    // ...$role
    public function handle($request, Closure $next, $role)
    {
        $user = Auth::user();

        if (Auth::guest()) {
            // throw UnauthorizedException::notLoggedIn();
            return redirect(route('login'));
            // throw new \Exception("Unauthorized");
        }

        $roles = is_array($role) ? $role : explode('|', $role);
        
        $legit = in_array($user->role, $roles);
        if(!$legit){
            try{
                $r = $user->role;
                if($r === "client"){
                    return redirect(route('client.home'));
                }
            }catch(\Exception $e){
                return abort(403, "Unauthorized role!");
            }
        }

        // if (! Auth::user()->hasAnyRole($roles)) {
        //     throw UnauthorizedException::forRoles($roles);
        // }
        
        return $next($request);
    }
}
