<?php

namespace App\Repositories;

use App\Models\UserLogin;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Arr;

class UserLoginRepository
{
    public static function allLogins(): Paginator
    {
        $loginsPagination = (int)config('pagination.all_logins');
        $userColumns = [
            'id',
            'name',
            'family_name',
            'given_name',
            'email',
            'email_verified',
            'hd',
            'locale',
            'google_id',
            'picture',
        ];

        return UserLogin::with([
            'user' => fn ($query) => $query->select($userColumns)
        ])
            ->orderBy('created_at', 'desc')
            ->simplePaginate($loginsPagination);
    }
}
