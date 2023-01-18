<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\ArtWork;
use App\Models\ArtWorkImage;
use App\Models\BidLog;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $auction = \App\Models\Auction::query()->where('id', 1)->first();
        $artWorks = ArtWork::factory(10)->create([
            'auction_id' => $auction->id,
        ]);

        foreach ($artWorks as $artWork) {
            ArtWorkImage::factory(10)->create([
                'art_work_id' => $artWork->id,
            ]);
            BidLog::factory(10)->create([
                'art_work_id' => $artWork->id,
                'user_id' => 1
            ]);
            $artWork->update(['end_price' => $artWork->getHighestBid()->bid_amount]);
        }

    }
}
