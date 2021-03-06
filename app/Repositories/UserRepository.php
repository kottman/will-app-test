<?php

namespace App\Repositories;

use App\Helpers\IsAdminHelper;
use App\Models\User;
use App\ValueObjects\ConstantObjects\Roles;
use App\ValueObjects\Structs\ProviderUserInfoStruct;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Str;

class UserRepository
{
    protected User $user;
    public const DETAILS_COLUMNS = [
        'id',
        'name',
        'email',
        'picture',
        'last_login',
    ];

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function details(): array
    {
        return [
            'name' => [
                'name' => 'Name',
                'value' => $this->user->name,
            ],
            'give_name' => [
                'name' => 'Given name',
                'value' => $this->user->given_name,
            ],
            'family_name' => [
                'name' => 'Family name',
                'value' => $this->user->family_name,
            ],
            'locale' => [
                'name' => 'Locale',
                'value' => $this->user->locale,
            ],
            'google_id' => [
                'name' => 'Google id',
                'value' => $this->user->google_id,
            ],
            'hd' => [
                'name' => 'Domain',
                'value' => $this->user->hd,
            ],
            'picture' => [
                'name' => 'Picture',
                'value' => $this->user->picture,
            ],
            'created_at' => [
                'name' => 'Created at',
                'value' => $this->user->created_at,
            ],
            'updated_at' => [
                'name' => 'Updated at',
                'value' => $this->user->updated_at,
            ],
            'login_count' => [
                'name' => 'Number of logins',
                'value' => $this->user->logins()->count(),
            ],
        ];
    }

    public static function allUsers(): Paginator
    {
        $usersPagination = (int)config('pagination.all_users');

        return User::withLastLogin()
            ->withCount('logins')
            ->select(static::DETAILS_COLUMNS)
            ->orderBy('last_login', 'desc')
            ->simplePaginate($usersPagination);
    }

    public static function storeFromProvider(ProviderUserInfoStruct $userInfoStruct): User
    {
        $user = User::firstOrCreate(
            [
                'email' => $userInfoStruct->email,
            ],
            $userInfoStruct->toArray()
        );

        static::assignRole($user);

        return $user;
    }

    public static function assignRole(User $user): void
    {
        if (IsAdminHelper::isAdmin($user)) {
            $user->assignRole(Roles::ROLE_ADMIN);
        }
    }
}
