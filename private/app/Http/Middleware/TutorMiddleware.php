<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
class TutorMiddleware
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
            //echo '<pre>';print_r(\Sentinel::getUser());
            //echo \Sentinel::getUser()->block;
            if(\Sentinel::getUser()->block){
                Session::flash('success','Your profile has been blocked for six months');
                return \Redirect::to('/dashboard?block=1');
            }
            if (\Sentinel::getUser()->roles()->first()->slug == 'tutor') {
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
