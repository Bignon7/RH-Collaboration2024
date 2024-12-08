<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user() && (Auth::user()->role == "Admin" || Auth::user()->role == "Gestionnaire")) {
            //Si les conditions sont vérifiées alors la requête peut passer
            return $next($request);
        }
        //Sinon on regirige la personne sur la page d'accueil
        return redirect('/');
    }
}
