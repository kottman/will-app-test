<?php

namespace App\Http\Controllers;

use App\Repositories\UserLoginRepository;
use App\Repositories\UserRepository;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('dashboard', [
            'users' => UserRepository::allUsers(),
            'logins' => UserLoginRepository::allLogins()
        ]);
    }

    public function allUsers()
    {
        return view('all-users', [
            'users' => UserRepository::allUsers(),
        ]);
    }

    public function allLogins()
    {
        return view('all-logins', [
            'logins' => UserLoginRepository::allLogins()
        ]);
    }
}
