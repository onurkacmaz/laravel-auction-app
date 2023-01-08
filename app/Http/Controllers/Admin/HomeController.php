<?php

namespace App\Http\Controllers\Admin;

use Illuminate\View\View;

class HomeController
{
    public function index(): View
    {
        return view('admin.index');
    }
}
