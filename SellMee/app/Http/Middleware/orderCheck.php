<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class orderCheck
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
            $model=$request->route('order');
            
         if($model->user_id != auth()->user()->id)
            return redirect()->back();
    
            return $next($request);
    }
}
