<?php

namespace App\Http\Controllers;

use App\Http\Services\ArtWorkService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class FollowController extends Controller
{
    public function myFollows(ArtWorkService $artWorkService): View {
        $follows = $artWorkService->getFollows(auth()->user());
        return view('account.follows.index', ['follows' => $follows]);
    }

    public function destroy(int $id, ArtWorkService $artWorkService): RedirectResponse
    {
        $artWorkService->deleteFollow($id, auth()->user()->getAuthIdentifier());

        return redirect()->back();
    }
}
