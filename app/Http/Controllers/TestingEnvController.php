<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthenticateTestingEnv;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class TestingEnvController extends Controller
{
    final public function askForAuthentication(): View
    {
        return view('testing.gate');
    }

    final public function authenticate(AuthenticateTestingEnv $request): RedirectResponse
    {
        $data = $request->validated();

        session()->put('testingSessionUsername', $data['username']);
        session()->put('testingSessionPassword', $data['password']);

        return redirect()->route('home');
    }
}