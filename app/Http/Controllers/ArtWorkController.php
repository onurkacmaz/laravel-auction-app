<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddOrRemoveFavoriteRequest;
use App\Http\Requests\BiddingRequest;
use App\Http\Requests\FollowOrUnFollowRequest;
use App\Http\Services\ArtWorkService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ArtWorkController extends Controller
{
    private ArtWorkService $artWorkService;

    public function __construct(ArtWorkService $artWorkService)
    {
        $this->artWorkService = $artWorkService;
    }

    public function addFavorite(int $id, AddOrRemoveFavoriteRequest $request): JsonResponse
    {
        $artWork = $this->artWorkService->getArtWorkById($id);

        if ($request->get('isFavorite')) {
            $artWork->favorites()->where('user_id', $request->user()->getAuthIdentifier())->delete();
        } else {
            $artWork->favorites()->updateOrCreate(['user_id' => $request->user()->getAuthIdentifier()]);
        }

        return response()->json(['success' => true, 'data' => [
            'count' => $artWork->favorites()->count()
        ]]);
    }

    public function follow(int $id, FollowOrUnFollowRequest $request): JsonResponse
    {
        $artWork = $this->artWorkService->getArtWorkById($id);

        if ($request->get('isFollow')) {
            $artWork->follows()->where('user_id', $request->user()->getAuthIdentifier())->delete();
        } else {
            $artWork->follows()->updateOrCreate(['user_id' => $request->user()->getAuthIdentifier()]);
        }

        return response()->json(['success' => true, 'data' => [
            'count' => $artWork->follows()->count()
        ]]);
    }

    public function bidding(int $id, BiddingRequest $request): JsonResponse
    {
        $artWork = $this->artWorkService->getArtWorkById($id);

        $artWork->bids()->create([
            'user_id' => $request->user()->getAuthIdentifier(),
            'bid_amount' => $request->get('bid_amount')
        ]);

        $artWork->update(['end_price' => $request->get('bid_amount')]);

        return response()->json(['success' => true, 'data' => [
            'message' => 'Teklif verildi.',
            'end_price' => Str::currency($artWork->end_price)
        ]]);
    }

    public function show(int $id): View
    {
        $artWork = $this->artWorkService->getArtWorkById($id);

        return view('auctions.artworks.show', [
            'artWork' => $artWork
        ]);
    }
}
