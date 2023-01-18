<?php

namespace App\Http\Services;

use App\Http\Requests\ArtistSaveRequest;
use App\Models\Artist;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class ArtistService
{
    public function getArtists(): LengthAwarePaginator
    {
        return Artist::query()->paginate(10);
    }

    public function getArtist(int $id): Artist|Model|null
    {
        return Artist::query()->where('id', $id)->first();
    }

    public function destroy(int $id): void
    {
        Artist::query()->where('id', $id)->delete();
    }

    public function updateOrCreate(ArtistSaveRequest $request, ?int $id): Artist|Model|null
    {
        return Artist::query()->updateOrCreate(
            ['id' => $id],
            $request->all()
        );
    }
}
