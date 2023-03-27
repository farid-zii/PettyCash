<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Http\Middleware\Auth;

class CheckLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    // public function handle(Request $request, Closure $next, ...$levels)
    // {
    //     if(in_array($request->user()->level, $levels)) {
    //         return $next($request);
    //     }

    //     if (Auth()->user()->level == 'admin') {

    //     }

    // }
    public function handle(Request $request, Closure $next)
    {
        $levels = array_slice(func_get_args(),2);

        foreach ($levels as $level) {
            $user = Auth()->user()->level;
            if($user == $level){
                //Jika akun sesuai dengan level maka akan dilanjutkan ke halaman yng sesuai
                return $next($request);
            }
        }

        return redirect('/');
    }
}
