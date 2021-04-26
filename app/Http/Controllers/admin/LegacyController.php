<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\RedirectResponse;

class LegacyController extends Controller
{
    final public function toggleLegacyProfile(User $user): RedirectResponse
    {
        $user->is_legacy = !$user->is_legacy;
        $user->save();

        return redirect()->back();
    }
}
