<?php

namespace App\Http\Middleware;

use Closure;
use App;

class ApiLocale
{
    public function handle($request, Closure $next)
    {
        if (isset($request->lang)) {
            App::setLocale($request->lang);
        } else {
            App::setLocale('ar');
        }
        return $next($request);
    }
}
