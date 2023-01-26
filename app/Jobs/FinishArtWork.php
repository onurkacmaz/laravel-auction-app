<?php

namespace App\Jobs;

use App\Http\Services\ArtWorkService;
use App\Http\Services\OneSignalService;
use App\Models\BidLog;
use App\Notifications\ArtWorkWon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class FinishArtWork implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private ArtWorkService $artWorkService;
    private BidLog $bid;
    private OneSignalService $oneSignalService;

    public function __construct(BidLog|Model $bid)
    {
        $this->oneSignalService = new OneSignalService();
        $this->artWorkService = new ArtWorkService();
        $this->bid = $bid;
    }

    public function handle(): void
    {
        $userArtWork = $this->artWorkService->finishArtWork($this->bid);
        if (!is_null($userArtWork)) {
            Notification::send($this->bid->user, new ArtWorkWon($this->bid));
        }
    }
}
