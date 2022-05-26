<?php

namespace App\Http\Middleware;

use Closure;

class CheckExamMarks
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->marks<=60){
            return response()->json(['status' => 'NG', 'message' => 'I am sorry,You did not make it this time!!!'], 200);
        }

        return $next($request);
    }
}
