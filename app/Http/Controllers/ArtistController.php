<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class ArtistController extends Controller
{
    public function show(int $id): View {
        return view('artists.show');
    }
}
