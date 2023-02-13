<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuctionApplication;
use App\Models\GeneralSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class AuctionApplicationController extends Controller
{
    public function index(): View
    {
        $applications = AuctionApplication::query()->paginate();

        return view('admin.auction-applications.index', [
            'applications' => $applications
        ]);
    }

    public function view(int $id): View {
        $application = AuctionApplication::query()->where('id', $id)->first();

        return view('admin.auction-applications.view', [
            'application' => $application
        ]);
    }

    public function destroy(int $id): RedirectResponse {
        AuctionApplication::query()->where('id', $id)->delete();

        return redirect()->route('admin.auction-applications.index')->with('success', 'Başvuru silindi.');
    }
}
