<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AuctionSaveRequest;
use App\Http\Services\AuctionService;
use App\Models\Auction;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AuctionController
{
    private AuctionService $auctionService;

    public function __construct(AuctionService $auctionService)
    {
        $this->auctionService = $auctionService;
    }

    public function index(): View
    {
        $auctions = $this->auctionService->getAuctions();
        return view('admin.auctions.index', [
            'auctions' => $auctions,
        ]);
    }

    public function new(): View {
        return view('admin.auctions.form', [
            'auction' => new Auction(),
        ]);
    }

    public function edit(int $id): View
    {
        $auction = $this->auctionService->getAuction($id);

        if (!$auction) {
            abort(404);
        }

        return view('admin.auctions.form', [
            'auction' => $auction,
        ]);
    }

    public function save(AuctionSaveRequest $request, int|null $id = null): RedirectResponse
    {
        $auction = $this->auctionService->updateOrCreate($request, $id);

        return redirect()->route('admin.auctions.edit', ['id' => $auction->id])->with('success', 'Müzayede başarıyla kaydedildi.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $this->auctionService->deleteAuction($id);
        return redirect()->back()->with('success', 'Müzayede başarıyla silindi.');
    }
}
