<?php

namespace App\Http\Services;

use App\Http\Requests\ArtWorkSaveRequest;
use App\Jobs\NewBid;
use App\Models\ArtWork;
use App\Models\ArtWorkGroup;
use App\Models\ArtWorkImage;
use App\Models\Auction;
use App\Models\BidLog;
use App\Models\User;
use App\Models\UserArtWork;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ArtWorkService
{
    public function getArtWorksGrouped(Auction|Model $auction, null|string $q = null): array {
        $groups = [];

        foreach ($this->getArtworkGroups() as $key => $group) {
            $auction->artWorks()->when(!is_null($q), function ($query) use ($q) {
                return $query->where('title', 'like', '%' . $q . '%');
            })->grouped($group)->each(function ($artWork) use (&$groups, $key, $group) {
                $groups[$key]['artWorks'][] = $artWork;
                $groups[$key]['title'] = $group->title;
            });
        }

        return $groups;
    }

    public function getArtWorkById(int $id): ArtWork|Model|null {
        return ArtWork::query()->where('id', $id)->withTrashed()->first();
    }

    public function getArtWorkByAuctionIdAndId(int $auctionId, int $id): ArtWork|null|Model
    {
        return ArtWork::query()->where('auction_id', $auctionId)->where('id', $id)->first();
    }

    public function deleteArtWork(int $auctionId, int $id): bool
    {
        return ArtWork::query()->where('auction_id', $auctionId)->where('id', $id)->delete();
    }

    public function getAllByUser(Authenticatable $user): LengthAwarePaginator
    {
        return UserArtWork::query()->where('user_id', $user->getAuthIdentifier())->with('artWork')->paginate(ArtWork::PAGINATION_LIMIT);
    }

    public function getByUser(int $id, Authenticatable $user): ArtWork|null|Model
    {
        return UserArtWork::query()->where('user_id', $user->getAuthIdentifier())->where('art_work_id', $id)->first();
    }

    public function updateOrCreate(ArtWorkSaveRequest $request, int $auctionId, int|null $id = null): ArtWork|Model
    {
        $images = array_filter($request->get('images'));

        $request->request->set('updated_at', Carbon::now());
        $request->request->remove('filepond');
        $request->request->remove('images');

        if ($id === null) {
            $request->request->set('end_price', $request->get('start_price'));
        }

        $artwork = ArtWork::query()->updateOrCreate(['id' => $id, 'auction_id' => $auctionId], $request->all());

        $sanitizedImages = [];
        foreach ($images as $image) {
            $path = sprintf("/artworks/%s/%s", $artwork->id, uniqid() . '.png');
            Storage::disk('public')->put($path, base64_decode(json_decode($image, true)['data']));
            $sanitizedImages[] = $path;
        }

        $willBeDelete = ArtWorkImage::query()->whereNotIn('path', $sanitizedImages)->where('art_work_id', $artwork->id)->get();
        foreach ($willBeDelete as $image) {
            Storage::delete("/public" . $image->path);
            $image->delete();
        }

        foreach ($sanitizedImages as $image) {
            ArtWorkImage::query()->updateOrCreate(['art_work_id' => $artwork->id, 'path' => $image]);
        }

        return $artwork;
    }

    public function getSimilarArtWorks(Model|ArtWork $artWork): Collection
    {
        if (Cache::has(sprintf("similar_artworks_%s", $artWork->id))) {
            return Cache::get(sprintf("similar_artworks_%s", $artWork->id));
        }

        $artWorks = ArtWork::query()->where('auction_id', $artWork->auction_id)->whereDoesntHave('userArtWork')->inRandomOrder()->limit(5)->get();
        Cache::put(sprintf("similar_artworks_%s", $artWork->id), $artWorks);

        return $artWorks;
    }

    public function search(string $keyword): LengthAwarePaginator
    {
        return ArtWork::query()->where('name', 'like', sprintf("%%%s%%", $keyword))->paginate(ArtWork::PAGINATION_LIMIT);
    }

    public function finishArtWork(BidLog|Model $bid): UserArtWork|Model|null
    {
        /** @var Carbon $lastBidCreatedAt */
        $lastBidCreatedAt = $bid->artWork->created_at;
        $period = [$lastBidCreatedAt, $lastBidCreatedAt->subMinutes(3)];

        $bids = BidLog::query()->where('art_work_id', $bid->art_work_id)->whereBetween('created_at', $period)->get();
        if ($bids->count() < 0 || $bid->id === $bid->artWork->bids()->first()->id) {
            return $this->defineArtWorkToUser($bid);
        }

        return null;
    }

    private function defineArtWorkToUser(Model|BidLog $bid): UserArtWork|Model
    {
        return UserArtWork::query()->create(['user_id' => $bid->user_id, 'art_work_id' => $bid->art_work_id]);
    }

    public function sendNewBidMail(BidLog|Model $bid): void
    {
        $emails = array_unique(array_merge(
            $bid->getBidsWithoutThis()->get()->pluck('user.email')->toArray(),
            $bid->artWork->follows()->whereNot('user_id', $bid->user->id)->get()->pluck('user.email')->toArray()
        ));

        $users = User::query()->whereIn('email', $emails)->get();

        $users->each(function (User $user) use ($bid) {
            Queue::push(new NewBid($user, $bid));
        });
    }

    public function getArtworkGroups(): Collection {
        return ArtWorkGroup::query()->get();
    }

    public function getBidsByUser(Authenticatable $user, string|null $q = null, int $page = 1): LengthAwarePaginator
    {
        return BidLog::query()->whereHas('artWork', function ($query) use ($q) {
            return $query->where('title', 'like', '%' . $q . '%');
        })->where('user_id', $user->getAuthIdentifier())->with('artWork')->paginate(ArtWork::PAGINATION_LIMIT, ['*'], 'page', is_null($q) ? $page : 1);
    }
}
