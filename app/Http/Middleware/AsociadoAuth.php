<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AsociadoAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! auth('asociado')->check()) {
            return redirect()->route('asociados.ingresar')
                ->with('mensaje', 'Debes ingresar para acceder a esta página.');
        }

        if (! auth('asociado')->user()->activo) {
            auth('asociado')->logout();
            $request->session()->invalidate();

            return redirect()->route('asociados.ingresar')
                ->with('error', 'Tu cuenta está inactiva. Contacta a ANASCOR para más información.');
        }

        return $next($request);
    }
}
