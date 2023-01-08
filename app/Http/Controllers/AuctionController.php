<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class AuctionController extends Controller
{
    public function index(): View {
        return view('auctions.index');
    }

    public function show(int $id): View {
        return view('auctions.show');
    }
}
