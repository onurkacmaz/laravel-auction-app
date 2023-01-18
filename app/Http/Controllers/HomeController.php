<?php

namespace App\Http\Controllers;

use App\Http\Services\AuctionService;
use App\Models\ArtWork;
use Illuminate\View\View;

class HomeController extends Controller
{
    private AuctionService $auctionService;

    public function __construct(AuctionService $auctionService)
    {
        $this->auctionService = $auctionService;
    }

    public function index (): View {
        $auction = $this->auctionService->getActiveAuction();

        if (!is_null($auction)) {
            $groups = [
                [
                    "begin" => 100000.00,
                    "end" => 999999999999999999,
                    "title" => "100.000 ÜSTÜ",
                    "artWorks" => []
                ],
                [
                    "begin" => 50000.00,
                    "end" => 100000.00,
                    "title" => "50.000 ÜSTÜ",
                    "artWorks" => []
                ],
                [
                    "begin" => 30000.00,
                    "end" => 50000.00,
                    "title" => "30.000 ÜSTÜ",
                    "artWorks" => []
                ],
                [
                    "begin" => 15000.00,
                    "end" => 30000.00,
                    "title" => "15.000 ÜSTÜ",
                    "artWorks" => []
                ],
                [
                    "begin" => 0,
                    "end" => 15000.00,
                    "title" => "15.000 ALTI",
                    "artWorks" => []
                ],
            ];
            /** @var ArtWork $artWork */
            foreach ($groups as $key => $group) {
                $auction->artWorks()->where('end_price', '>', $group['begin'])->where('end_price', '<', $group['end'])->groupBy( 'end_price', 'id')->each(function ($artWork) use (&$groups, $key) {
                    $groups[$key]['artWorks'][] = $artWork;
                });
            }
        }

        return view('index', [
            'auction' => $auction,
            'groups' => $groups ?? []
        ]);
    }
}
