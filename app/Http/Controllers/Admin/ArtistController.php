<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ArtistSaveRequest;
use App\Http\Services\ArtistService;
use App\Models\Artist;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ArtistController
{
    private ArtistService $artistService;

    public function __construct(ArtistService $artistService)
    {
        $this->artistService = $artistService;
    }

    public function index(): View
    {
        $artists = $this->artistService->getArtists();
        return view('admin.artists.index', [
            'artists' => $artists
        ]);
    }

    public function new(): View
    {
        return view('admin.artists.form', [
            'artist' => new Artist()
        ]);
    }

    public function edit(int $id): View
    {
        $artist = $this->artistService->getArtist($id);
        return view('admin.artists.form', [
            'artist' => $artist
        ]);
    }

    public function save(ArtistSaveRequest $request, int $id = null): RedirectResponse {
        $artist = $this->artistService->updateOrCreate($request, $id);

        return redirect()->route('admin.artists.edit', [
            'id' => $artist->id
        ]);
    }

    public function destory(int $id): RedirectResponse
    {
        $this->artistService->destroy($id);

        return redirect()->route('admin.artists.index')->with('success', 'Kayıt başarıyla silindi.');
    }
}
