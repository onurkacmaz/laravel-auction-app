<?php

namespace App\Jobs;

use App\Http\Services\ArtWorkService;
use App\Http\Services\AuctionService;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class FinishAuction implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private ArtWorkService $artWorkService;
    private AuctionService $auctionService;

    public function __construct()
    {
        $this->auctionService = new AuctionService();
        $this->artWorkService = new ArtWorkService();
    }

    public function handle(): void
    {
        $auction = $this->auctionService->getActiveAuction();

        if (!is_null($auction) && Carbon::parse($auction->end_date)->isPast()) {
            foreach ($auction->artWorks as $artwork) {
                $this->artWorkService->closeArtwork($artwork);
            }
            $auction->update(['status' => false]);
        }
    }
}
