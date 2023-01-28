<?php

namespace App\Http\Controllers;

use App\Http\Services\ArtWorkService;
use App\Http\Services\AuctionService;
use App\Models\ArtWork;
use App\Models\Auction;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class SearchController extends Controller
{
    private AuctionService $auctionService;
    private ArtWorkService $artWorkService;

    public function __construct(AuctionService $auctionService, ArtWorkService $artWorkService)
    {
        $this->auctionService = $auctionService;
        $this->artWorkService = $artWorkService;
    }

    public function search(Request $request): View {

        $auction = $this->auctionService->getActiveAuction();
        $auction->image = null;

        $groups = $this->artWorkService->getArtWorksGrouped($auction, $request->get('q'));

        return view('index', [
            'title' => sprintf('Arama Sonuçları - %s', $request->filled('q') ? Str::inlineMarkdown("**" . $request->get('q') . "**") : null),
            'auction' => $auction,
            'groups' => $groups ?? []
        ]);
    }
}
