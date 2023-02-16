<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddOrRemoveFavoriteRequest;
use App\Http\Requests\BiddingRequest;
use App\Http\Requests\FollowOrUnFollowRequest;
use App\Http\Services\ArtWorkService;
use App\Http\Services\AuctionService;
use App\Jobs\FinishArtWork;
use App\Models\BidLog;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class ArtWorkController extends Controller
{
    private ArtWorkService $artWorkService;
    private AuctionService $auctionService;

    public function __construct(ArtWorkService $artWorkService, AuctionService $auctionService)
    {
        $this->artWorkService = $artWorkService;
        $this->auctionService = $auctionService;
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

        if (!is_null($artWork->userArtWork)) {
            throw new UnprocessableEntityHttpException("Bu esere artık teklif veremezsiniz.");
        }

        $bid = $artWork->bids()->create([
            'user_id' => $request->user()->getAuthIdentifier(),
            'bid_amount' => $request->get('bid_amount')
        ]);

        if ($this->auctionService->isLastXMinutes(3, $artWork->auction->end_date)) {
            $this->auctionService->extendEndDate($artWork->auction, 3);
        }

        $artWork->update(['end_price' => $bid->bid_amount]);

        Queue::later(now()->addMinutes(3), new FinishArtWork($bid));

        $this->artWorkService->sendNewBidMail($bid);

        return response()->json(['success' => true, 'data' => [
            'message' => 'Teklif verildi.',
            'end_price' => Str::currency($artWork->end_price),
            'min_bid_amount' => Str::currency($artWork->minimum_bid),
            'min_bid_amount_without_currency' => $artWork->minimum_bid,
            'bid_count' => $artWork->bids()->count()
        ]]);
    }

    public function show(int $id): View
    {
        $artWork = $this->artWorkService->getArtWorkById($id);

        return view('auctions.artworks.show', [
            'artWork' => $artWork,
            'similarArtWorks' => $this->artWorkService->getSimilarArtWorks($artWork),
        ]);
    }

    public function bids(int $id, Request $request): JsonResponse {
        $artWork = $this->artWorkService->getArtWorkById($id);
        $bids = $artWork->bids()->simplePaginate(BidLog::PAGINATION_LIMIT, ['*'], 'page', $request->get('page'))->setPath(route('auctions.artworks.show', ['id' => $artWork->id]));
        return response()->json(['success' => true, 'data' => [
            'html' => view('components.bids', ['bids' => $bids, 'hideName' => !Str::of($request->headers->get('referer'))->contains('admin')])->render()
        ]]);
    }
}
