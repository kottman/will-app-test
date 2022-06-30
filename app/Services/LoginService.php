<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserLogin;
use App\Repositories\UserRepository;
use App\ValueObjects\Structs\ProviderUserInfoStruct;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Contracts\User as SocialiteUser;

class LoginService
{
    protected SocialiteUser $socialiteUser;

    public function __construct(SocialiteUser $socialiteUser)
    {
        $this->socialiteUser = $socialiteUser;
    }

    public function handle(): void
    {
        $userInfo = $this->socialiteUser->user;
        $userInfo['hd'] = $userInfo['hd'] ?? 'gmail';
        $userInfo['google_id'] = $userInfo['id'];
        $user = UserRepository::storeFromProvider(new ProviderUserInfoStruct($userInfo));

        $this->login($user);
    }

    protected function login(User $user): void
    {
        UserLogin::create(['user_id' => $user->id]);

        Auth::login($user, true);
    }
}
