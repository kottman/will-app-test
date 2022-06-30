<?php

namespace App\Repositories;

use App\Models\UserLogin;
use Illuminate\Contracts\Pagination\Paginator;

class UserLoginRepository
{
    public const ALL_LOGINS_PAGINATION = 2;

    public static function allLogins(): Paginator
    {
        return UserLogin::with('user')->simplePaginate(static::ALL_LOGINS_PAGINATION);
    }
}
