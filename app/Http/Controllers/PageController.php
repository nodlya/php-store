<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Page $page) {
        return view('page', compact('page'));
    }
}
