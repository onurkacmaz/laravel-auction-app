<?php

namespace App\Http\Controllers;

use App\Http\Services\ArtWorkService;
use App\Http\Services\AuctionService;
use App\Models\AuctionApplication;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class HomeController extends Controller
{
    private AuctionService $auctionService;
    private ArtWorkService $artWorkService;

    public function __construct(AuctionService $auctionService, ArtWorkService $artWorkService)
    {
        $this->auctionService = $auctionService;
        $this->artWorkService = $artWorkService;
    }

    public function index(): View {
        $auction = $this->auctionService->getActiveAuction();

        if (!is_null($auction)) {

            if (Cache::has('groups')) {
                $groups = Cache::get('groups');
            }else {
                $groups = $this->artWorkService->getArtWorksGrouped($auction);
                Cache::set('groups', $groups);
            }
        }

        return view('index', [
            'auction' => $auction,
            'groups' => $groups ?? []
        ]);
    }

    public function sendApplication(Request $request): RedirectResponse {
        AuctionApplication::query()->create($request->all());

        return redirect()->back()->with('success', 'Başvurunuz başarıyla gönderildi.');
    }
}
