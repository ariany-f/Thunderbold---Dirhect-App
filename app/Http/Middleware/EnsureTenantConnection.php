<?php

namespace App\Http\Middleware;

use App\Actions\TenantConnection;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureTenantConnection
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(($user = $request?->user()) === null)
        {
            return $next($request);
        }
        app(TenantConnection::class, [
            'user' => $user
        ])->execute('company'.$user->company_id);

        return $next($request);
    }
}
