<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {   

        if($request->session()->has('ADMIN_LOGIN')){
          

        }else{
            $request->session()->flash('denied','Access Denied For that Page');
            return redirect('admin/login');

        }

        return $next($request);
    }
}
