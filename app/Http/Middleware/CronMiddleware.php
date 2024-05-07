<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
// use Spatie\Permission\Exceptions\UnauthorizedException;
use Arr;
use Log;

class CronMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    // ...$role
    public function handle($request, Closure $next)
    {
        $g = Arr::get($_GET, "s");
		Log::error("cmw g $g");

		// 1337secret 5bb88e02bb0244e72c25cef3fb885bb5
		$c = $g != md5(env("CRON_SECRET"));
		Log::info([$g, md5(env("CRON_SECRET")), $c]);

		if($c){
			throw new \Exception("secret is not provided!");
		}
        // if (! Auth::user()->hasAnyRole($roles)) {
        //     throw UnauthorizedException::forRoles($roles);
        // }
        
        return $next($request);
    }
}
