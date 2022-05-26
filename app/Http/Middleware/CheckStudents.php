<?php

namespace App\Http\Middleware;

use Closure;

class CheckStudents
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
        if ($request ->Age<=18){
            return response()->json(['status' => 'NG', 'message' => 'You cannot attend University, Attend Primary School!!!'], 200);
        }

        //  if ($request ->Age>18){
        //      return response()->json(['status' => 'NG', 'message' => 'You are not Primary student'], 200);
        //  }
        return $next($request);
    }
}
