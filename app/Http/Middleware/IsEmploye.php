<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsEmploye
{
    public function handle(Request $request, Closure $next)
    {
        if (!in_array(auth()->user()->role, ['employe', 'admin'])) {
            return response()->json([
                'message' => 'Accès réservé aux employés'
            ], 403);
        }

        return $next($request);
    }
}