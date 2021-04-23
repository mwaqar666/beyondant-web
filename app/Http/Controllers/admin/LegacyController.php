<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Contracts\View\View;

class LegacyController extends Controller
{
    final public function index(User $user): View
    {
        $publicComments = $user->load('');

        return view('front.legacy-account');
    }
}
