<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

 

class UserMiddleware
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
        $user_id = Auth::user()->id;

        $user_type = User::select('usertype')->where('id',$user_id)->first();
        $people = array("1", "doctor", "wordboy", "nures","patient");
       
        $user_type = $user_type->usertype;
        
        if(in_array($user_type, $people)){

           
            return $next($request);
        }
        else{
            
            return redirect()->back();
        }
       
    }
}
