<?php

namespace App\Http\Middleware;

use App\models\setting;
use Closure;
use Illuminate\Http\Request;

class allowguest
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $setting = setting::findOrFail(1);
        view()->share(
            'setting', $setting
        );

        return $next($request);
    }
}
