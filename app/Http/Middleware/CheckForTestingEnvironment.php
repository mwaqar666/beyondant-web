<?php
/** @noinspection LaravelFunctionsInspection, MissingService, CaseSensitivityServiceInspection, PhpMissingReturnTypeInspection */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckForTestingEnvironment
{
    public function handle(Request $request, Closure $next)
    {
        $testingEnv = env('TEST_ENV');

        if (!$testingEnv) {
            return $next($request);
        }

        [$testingSessionUsername, $testingSessionPassword] = [session()->get('testingSessionUsername'), session()->get('testingSessionPassword')];

        if (!$testingSessionUsername || !$testingSessionPassword) {

            return redirect()->route('validate-testing-env');
        }

        return $next($request);
    }
}
