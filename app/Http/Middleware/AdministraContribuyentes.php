<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdministraContribuyentes
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! in_array($request->user()?->role, ['administrador', 'super_usuario'], true)) {
    abort(403, 'No tienes permiso para realizar esta acción.');
    }

    return $next($request);
    }
}
