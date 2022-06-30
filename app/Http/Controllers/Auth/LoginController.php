<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\LoginService;
use App\ValueObjects\ConstantObjects\Roles;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Redirector;
use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function redirectToProvider(): \Symfony\Component\HttpFoundation\RedirectResponse|RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallback(): Application|RedirectResponse|Redirector
    {
        try {
            $providerUser = Socialite::driver('google')->user();
        } catch (\Exception $ex) {
            return redirect('/')->withErrors(['Account is not configured']);
        }

        (new LoginService($providerUser))->handle();

        return $this->redirectTo();
    }

    protected function redirectTo(): Application|RedirectResponse|Redirector
    {
        return Auth::user()->hasRole(Roles::ROLE_ADMIN)
            ? redirect('/dashboard')
            : redirect('/home');
    }
}
