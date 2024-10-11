<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class KiemTraTuoi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $age = $request->session()->get('age');

        if ($age < 18) {
            return redirect('/')->with('error', 'Thiếu niên chưa đủ 18 tuổi để xem phim.');
        }

        return $next($request);
    }
}
