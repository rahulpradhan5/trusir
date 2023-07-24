<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use DB;

class courseCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Session()->get('role') == "student") {
            $coursCheck = DB::table('course_purchased')->where('user_id', Session()->get('user_id'))->get();
            if ($coursCheck->count() > 0) {
                return $next($request);
            }else{
                return redirect()->route('courses');
            }
        } else {
            return $next($request);
        }
    }
}
