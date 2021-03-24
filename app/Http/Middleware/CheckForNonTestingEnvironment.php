<?php
/** @noinspection LaravelFunctionsInspection, PhpMissingReturnTypeInspection, MissingService, CaseSensitivityServiceInspection */


namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckForNonTestingEnvironment
{
    final public function handle(Request $request, Closure $next)
    {
        $testingEnv = env('TEST_ENV');
        [$testingSessionUsername, $testingSessionPassword] = [session()->get('testingSessionUsername'), session()->get('testingSessionPassword')];

        if ($testingEnv && (!$testingSessionUsername || !$testingSessionPassword)) {
            return $next($request);
        }

        return redirect()->route('home');
    }
}