<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Contracts\View\View;

class LandingController extends Controller
{
    /**
     * Show the landing page, with some recent, public images.
     *
     * @return View
     */
    public function __invoke()
    {
        $images = Image::query()->where('public', true)->orderByDesc('created_at')->limit(12)->get();
        return view('landing', ['recentImages' => $images]);
    }
}
