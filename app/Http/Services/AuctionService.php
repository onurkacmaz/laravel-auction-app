<?php

namespace App\Http\Services;

use App\Models\Auction;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AuctionService
{
    public function getAuctions(): LengthAwarePaginator
    {
        return Auction::query()->paginate(Auction::PAGINATION_LIMIT);
    }

    public function deleteAuction(int $id): void
    {
        Auction::query()->where('id', $id)->delete();
    }

    public function getAuction(int $id): Auction|Model|null
    {
        return Auction::query()->where('id', $id)->first();
    }

    public function updateOrCreate(Request $request, int $id = null): Auction|Model
    {
        $auction = $this->getAuction($id);

        $image = json_decode($request->get('image'), true);

        if (!is_null($image)) {
            Storage::delete("/public" . $auction->image);
            $imagePath = sprintf("/auctions/%s/%s", $id, uniqid() . '.png');
            Storage::put("/public" .$imagePath, base64_decode($image['data']));
            $image = $imagePath;
        }

        $request->request->set('updated_at', Carbon::now());
        $request->request->set('start_date', Carbon::parse($request->get('start_date')));
        $request->request->set('end_date', Carbon::parse($request->get('end_date')));
        $request->request->set('image', $image);

        return $auction->query()->updateOrCreate(['id' => $id], $request->all());
    }

    public function getActiveAuction(): Auction|Model|null
    {
        return Auction::query()->where('start_date', '<=', Carbon::now())->where('end_date', '>=', Carbon::now())->where('status', true)->first();
    }

    public function isLastXMinutes(int $minutes, $date): bool {
        return Carbon::now()->diffInMinutes($date) <= $minutes;
    }

    public function extendEndDate(int|Auction|Model $auction, int $minutes): void
    {
        if (is_int($auction)) {
            $auction = $this->getAuction($auction);
        }

        $auction->update(['end_date' => Carbon::parse($auction->end_date)->addMinutes($minutes)]);
    }

    public function getArchivedAuctions(): LengthAwarePaginator
    {
        return Auction::query()->where('status', true)->where('end_date', '<', Carbon::now())->paginate(Auction::PAGINATION_LIMIT);
    }
}
