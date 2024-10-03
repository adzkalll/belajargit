<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Laboratorium;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PemilikLab
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth('sanctum')->user();
        $lab = Laboratorium::findOrFail($request->id);

        if ($lab->user_id != $user->id) {
            return response()->json(['message' => 'data tidak ada bro' ], 404);
        }

        return $next($request);
    }
}
