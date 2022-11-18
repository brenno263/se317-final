<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function __invoke()
    {
        $images = Image::query()->where('public', true)->orderByDesc('created_at')->limit(12)->get();
        return view('landing', ['recentImages' => $images]);
    }
}
