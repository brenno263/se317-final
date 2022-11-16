<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function __invoke() {
        /** @var User $user */
        $user = Auth::user();

        $recent_images = $user->images()->orderBy('created_at')->limit(5)->get();

        return view('users.dashboard', [
            'user' => $user,
            'recent_images' => $recent_images
        ]);
    }
}