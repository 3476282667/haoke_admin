<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CORS
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        header('Access-Control-Allow-Origin: http://localhost:3000');
        header('Access-Control-Allow-Credentials: false');
        header('Access-Control-Allow-Methods:GET,POST,OPTIONS,DELETE,PUT');
        header("Access-Control-Allow-Headers: Token,Accept,content-type,Referer,Host,Keep-Alive,User-Agent,X-Requested-With,Cache-Control,Cookie,Authorization");
        header('Access-Control-Expose-Headers: Authorization');

        if (($_SERVER['REQUEST_METHOD'] ?? '') == 'OPTIONS') {
            header('Access-Control-Max-Age:86400');
            header('HTTP/1.0 204 No Content');
            header('Content-Length:0');
            header('status:204');
            exit();
        }
        return $next($request);
    }
}
