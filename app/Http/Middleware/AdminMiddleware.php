<?php

namespace App\Http\Middleware;

use App\ValueObjects\ConstantObjects\Roles;
use Illuminate\Http\Request;
Use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\UnauthorizedException;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): mixed
    {
        if (!Auth::user()->hasRole(Roles::ROLE_ADMIN)) {
            throw new UnauthorizedException();
        }

        return $next($request);
    }
}
