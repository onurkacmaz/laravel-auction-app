<?php

namespace App\Http\Controllers;

use App\Http\Services\ArtWorkService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class FavoriteController extends Controller
{
    public function myFavorites(ArtWorkService $artWorkService): View {
        $favorites = $artWorkService->getFavorites(auth()->user());
        return view('account.favorites.index', ['favorites' => $favorites]);
    }

    public function destroy(int $id, ArtWorkService $artWorkService): RedirectResponse
    {
        $artWorkService->deleteFavorite($id, auth()->user()->getAuthIdentifier());

        return redirect()->back();
    }
}
