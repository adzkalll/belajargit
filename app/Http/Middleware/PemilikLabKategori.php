<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\LabCategories;
use Symfony\Component\HttpFoundation\Response;

class PemilikLabKategori
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth('sanctum')->user();
        $labkat = LabCategories::findOrFail($request->id);

        if ($labkat->author != $user->id) {
            return response()->json(['message' => 'data tidak ada bro' ], 404);
        }

        return $next($request);
    }
}
