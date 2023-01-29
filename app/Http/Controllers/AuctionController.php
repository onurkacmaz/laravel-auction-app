<?php

namespace App\Http\Controllers;

use App\Http\Services\ArtWorkService;
use App\Http\Services\AuctionService;
use Illuminate\View\View;

class AuctionController extends Controller
{
    private AuctionService $auctionService;
    private ArtWorkService $artWorkService;

    public function __construct(AuctionService $auctionService, ArtWorkService $artWorkService)
    {
        $this->auctionService = $auctionService;
        $this->artWorkService = $artWorkService;
    }

    public function show(int $id): View {
        $auction = $this->auctionService->getAuction($id);

        if (!is_null($auction)) {
            $groups = $this->artWorkService->getArtWorksGrouped($auction);
        }

        return view('index', [
            'auction' => $auction,
            'groups' => $groups ?? []
        ]);
    }

    public function archive(): View {
        $auctions = $this->auctionService->getArchivedAuctions();

        return view('auctions.archive', [
            'auctions' => $auctions
        ]);
    }
}
