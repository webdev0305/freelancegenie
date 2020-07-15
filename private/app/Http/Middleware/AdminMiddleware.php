<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = \Sentinel::check();
        if (!empty($user) && $user != '') {
            if (\Sentinel::getUser()->roles()->first()->slug == 'admin') {
                $response = $next($request);
                return $response->header('Cache-Control', 'nocache, no-store, max-age=0, must-revalidate')
                    ->header('Pragma', 'no-cache')
                    ->header('Expires', 'Sun, 02 Jan 1990 00:00:00 GMT');
            } else {
                return \Redirect::to('/');
            }
        } else {
            return \Redirect::to('/login');
        }
    }
}
