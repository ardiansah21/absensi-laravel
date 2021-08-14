<?php

namespace App\Http\Middleware;

use Closure;

class IpMiddleware
{
    public $whiteIps = ['175.158.36.117', '36.71.138.47'];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    // public function handle($request, Closure $next, ...$ips)
    public function handle($request, Closure $next)
    {
        // $access = array_filter(array_map(function ($v) {
        //     return ($star = strpos($v, "*")) ? (substr(getenv('REMOTE_ADDR'), 0, $star) == substr($v, 0, $star))
        //     : (getenv('REMOTE_ADDR') == $v);
        // }, $ips));

        // // return $access ? $next($request) : App::abort(403);
        // return $access ? $next($request) : redirect()->back()->with('error', 'Akses Dilarang. Harap pastikan anda menggunakan jaringan WIFI kantor Seruni.');

        if (!in_array($request->ip(), $this->whiteIps)) {
            return redirect()->back()->with('error', 'Akses Dilarang. Harap pastikan anda menggunakan jaringan WIFI kantor Seruni.');
        }

        return $next($request);
    }
}
