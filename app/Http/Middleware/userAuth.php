<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class userAuth
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
        if(session()->has('loginId')){
            if(url('login')== $request->url() || url('register')==$request->url() ||  url('dashboard')==$request->url()  ){
                return back()->with('fail', "You don't havehave  to access view this page");
            }
           elseif( url('dashboard') == $request->url()){
            return back()->with('fail', "You don't have to accessaccess view this page");
            }else{
            }
            
        }
        return $next($request);
    }
}
