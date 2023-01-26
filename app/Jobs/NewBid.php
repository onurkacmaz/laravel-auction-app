<?php

namespace App\Jobs;

use App\Http\Services\OneSignalService;
use App\Models\BidLog;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewBid as NewBidNotification;

class NewBid implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private User $user;
    private BidLog $bid;
    private OneSignalService $oneSignalService;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, BidLog|Model $bid)
    {
        $this->oneSignalService = new OneSignalService();
        $this->user = $user;
        $this->bid = $bid;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        Notification::send($this->user, new NewBidNotification($this->bid));
    }
}
