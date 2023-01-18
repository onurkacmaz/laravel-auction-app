<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ArtWorkSaveRequest;
use App\Http\Services\ArtWorkService;
use App\Models\Artist;
use App\Models\ArtWork;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ArtWorkController
{
    private ArtWorkService $artWorkService;

    public function __construct(ArtWorkService $artWorkService)
    {
        $this->artWorkService = $artWorkService;
    }

    public function new(int $auctionId): View {
        $artWork = new ArtWork();
        $artWork->auction_id = $auctionId;

        return view('admin.auctions.artworks.form', [
            'artWork' => $artWork,
            'artists' => Artist::all()
        ]);
    }

    public function edit(int $auctionId, int $id): View
    {
        $artWork = $this->artWorkService->getArtWorkByAuctionIdAndId($auctionId, $id);

        if (!$artWork) {
            abort(404);
        }

        return view('admin.auctions.artworks.form', [
            'artWork' => $artWork,
            'artists' => Artist::all()
        ]);
    }

    public function save(ArtWorkSaveRequest $request, int $auctionId, int|null $id = null): RedirectResponse
    {
        $artWork = $this->artWorkService->updateOrCreate($request, $auctionId, $id);

        return redirect()->route('admin.auctions.artworks.edit', ['auction_id' => $artWork->auction->id, 'id' => $artWork->id])->with('success', 'Eser başarıyla kaydedildi.');
    }

    public function destroy(int $auctionId, int $id): RedirectResponse
    {
        $this->artWorkService->deleteArtWork($auctionId, $id);
        return redirect()->back()->with('success', 'Eser başarıyla silindi.');
    }
}
