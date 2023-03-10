<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Services\ArtWorkService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class AccountController extends Controller
{
    private ArtWorkService $artWorkService;

    public function __construct(ArtWorkService $artWorkService)
    {
        $this->artWorkService = $artWorkService;
    }

    public function index(): View {
        return view('account.index');
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('account.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function artworks(): View {
        $userArtWorks = $this->artWorkService->getAllByUser(Auth::user());
        return view('account.artworks.index', ['userArtWorks' => $userArtWorks]);
    }

    public function myBids(Request $request): View|JsonResponse {
        $bids = $this->artWorkService->getBidsByUser(Auth::user(), $request->get('q'), $request->get('page', 1));

        if ($request->ajax()) {
            return response()->json([
                'html' => view('components.my-bids', [
                    'bids' => $bids,
                ])->render(),
            ]);
        }

        return view('account.my-bids.index', [
            'bids' => $bids,
        ]);
    }

    public function artwork(int $id): View {
        $userArtWork = $this->artWorkService->getByUser($id, Auth::user());

        if (!$userArtWork) {
            abort(404);
        }

        return view('account.artworks.show', ['userArtWork' => $userArtWork]);
    }
}
