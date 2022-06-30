<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Illuminate\Contracts\{
    Foundation\Application,
    View\Factory,
    View\View,
};
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function home(): Factory|View|Application
    {
        $userInfo = (new UserRepository(Auth::user()))->details();

        return view('home', [
            'user' => $userInfo,
        ]);
    }
}
