<?php

namespace App\Http\Controllers;

use App\Http\Requests\Legacy\CreateLegacyCommentRequest;
use App\models\Legacy;
use App\models\LegacyPrivateComment;
use App\models\LegacyPublicComment;
use App\User;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class LegacyController extends Controller
{
    final public function index(User $user)
    {
        if (!$user->is_legacy) {

            return redirect()->route('pro', $user->id);
        }

        $relationsToLoad = ['publicComments', 'legacyTimeline'];

        if (auth()->check() && auth()->id() === $user->id) {
            $relationsToLoad[] = 'privateComments.user:id,profile_picture';
        }

        $user->load([
            'legacy' => static function (HasOne $legacy) use ($relationsToLoad) {
                $legacy->with($relationsToLoad);
            },
        ]);

        return view('front.legacy-account', compact('user'));
    }

    final public function createPublicComment(Legacy $legacy, CreateLegacyCommentRequest $request): JsonResponse
    {
        $publicComment = new LegacyPublicComment($request->validated());
        $created = $publicComment->legacy()->associate($legacy)->save();

        return response()->json(['message' => $created, 'comment' => $publicComment]);
    }

    final public function createPrivateComment(Legacy $legacy, User $user, CreateLegacyCommentRequest $request): RedirectResponse
    {
        $privateComment = new LegacyPrivateComment($request->validated());
        $privateComment->user()->associate($user);
        $privateComment->legacy()->associate($legacy);
        $privateComment->save();

        return redirect()->route('legacy', $legacy->user->id)->with(['message' => 'Commented Successfully']);
    }
}
