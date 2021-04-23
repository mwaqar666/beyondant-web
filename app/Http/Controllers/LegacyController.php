<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Database\Eloquent\Relations\HasOne;

class LegacyController extends Controller
{
    final public function index(User $user)
    {
        if (!$user->is_legacy) {

            return redirect()->route('pro', $user->id);
        }

        $user->load([
            'legacy' => static function (HasOne $legacy) {
                $legacy->with(['publicComments', 'legacyTimeline']);
            }
        ]);

        return view('front.legacy-account', compact('user'));
    }
}
