<?php

namespace App\Helpers;

use App\Models\User;
use App\ValueObjects\ConstantObjects\Roles;
use Illuminate\Support\Str;

class IsAdminHelper
{
    public static function isAdmin(User $user): bool
    {
        return static::checkDomain($user->email)
            || static::checkEmail($user->email)
            || static::checkName($user->name);
    }

    public static function checkName(string $name): bool
    {
        return Str::contains($name, config('admin-role-criteria.name_part'));
    }

    public static function checkDomain(string $email): bool
    {
        $matchEmail = config('admin-role-criteria.domain');
        $userDomain = explode('@', $email)[1];

        return $matchEmail === $userDomain
            || Str::endsWith($userDomain, ".{$matchEmail}");
    }

    public static function checkEmail(string $email): bool
    {
        return config('admin-role-criteria.email') === $email;
    }
}
