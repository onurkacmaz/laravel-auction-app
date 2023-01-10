<?php

namespace App\Http\Services;

use App\Http\Requests\ArtWorkSaveRequest;
use App\Models\ArtWork;
use App\Models\ArtWorkImage;
use App\Models\UserArtWork;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

class ArtWorkService
{
    public const ARTWORKS_PER_PAGE = 10;

    public function getAllArtWorks(): LengthAwarePaginator
    {
        return ArtWork::query()->paginate(self::ARTWORKS_PER_PAGE);
    }

    public function getArtWorkById(int $auctionId, int $id): ArtWork|null|Model
    {
        return ArtWork::query()->where('auction_id', $auctionId)->where('id', $id)->first();
    }

    public function deleteArtWork(int $auctionId, int $id): bool
    {
        return ArtWork::query()->where('auction_id', $auctionId)->where('id', $id)->delete();
    }

    public function getAllByUser(Authenticatable $user): LengthAwarePaginator
    {
        return UserArtWork::query()->where('user_id', $user->getAuthIdentifier())->with('artWork')->paginate(self::ARTWORKS_PER_PAGE);
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

        $artwork = ArtWork::query()->updateOrCreate(['id' => $id, 'auction_id' => $auctionId], $request->all());

        $sanitizedImages = [];
        foreach ($images as $image) {
            $sanitizedImages[] = sprintf("data:image/png;base64, %s", json_decode($image, true)['data']);
        }

        ArtWorkImage::query()->whereNotIn('path', $sanitizedImages)->where('art_work_id', $artwork->id)->delete();

        foreach ($sanitizedImages as $image) {
            ArtWorkImage::query()->updateOrCreate(['art_work_id' => $artwork->id, 'path' => $image]);
        }

        return $artwork;
    }
}
