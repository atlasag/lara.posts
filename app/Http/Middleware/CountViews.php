<?php

namespace App\Http\Middleware;

use App\Post;
use Closure;

class CountViews
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
        if ($request->isMethod('get') && $request->is('posts/*/'))
        {

        }
        return $next($request);
    }
}
