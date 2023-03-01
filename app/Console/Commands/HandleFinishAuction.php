<?php

namespace App\Console\Commands;

use App\Jobs\FinishAuction;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Queue;

class HandleFinishAuction extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auction:finish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will finish the auction';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Queue::push(new FinishAuction());
        return Command::SUCCESS;
    }
}
