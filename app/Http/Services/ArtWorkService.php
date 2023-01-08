<?php

namespace App\Http\Services;

use App\Models\ArtWork;
use App\Models\UserArtWork;
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

    public function getArtWorkById(int $id): ArtWork|null|Model
    {
        return ArtWork::query()->where('id', $id)->first();
    }

    public function createArtWork(array $data): ArtWork|Model
    {
        return ArtWork::query()->create($data);
    }

    public function deleteArtWork(int $id): bool
    {
        return ArtWork::query()->where('id', $id)->delete();
    }

    public function updateArtWork(int $id, array $data): bool
    {
        return ArtWork::query()->where('id', $id)->update($data);
    }

    public function getAllByUser(Authenticatable $user): LengthAwarePaginator
    {
        return UserArtWork::query()->where('user_id', $user->getAuthIdentifier())->with('artWork')->paginate(self::ARTWORKS_PER_PAGE);
    }

    public function getByUser(int $id, Authenticatable $user): ArtWork|null|Model
    {
        return UserArtWork::query()->where('user_id', $user->getAuthIdentifier())->where('id', $id)->first();
    }
}
