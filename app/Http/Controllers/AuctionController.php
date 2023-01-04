<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class AuctionController extends Controller
{
    public function index(): View {
        return view('index');
    }
}
