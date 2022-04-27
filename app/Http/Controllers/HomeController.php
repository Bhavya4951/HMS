<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

use Exception;

class HomeController extends Controller
{
    public function redirect(){

        if (Auth::id()) {
            
                if (Auth::user()->usertype == 1 || Auth::user()->usertype == "doctor" || Auth::user()->usertype == "wordboy" || Auth::user()->usertype == "nures" || Auth::user()->usertype == "patient") {     
                    return redirect('/dashboards');
                    //return view('admin.admin_home');
                }
                
                else{

                    return view('user.user_home');
                }
        }
        
        else{
        
                return redirect()->back();
        }    
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
       
        try {
           
          
            $user = Socialite::driver('google')->stateless()->user();

            // dd($user); 
            
            $finduser = User::where('google_id', $user->id)->first();
            // dd($finduser);
            if($finduser){
       
                Auth::login($finduser);
      
                  
                return  redirect('/home');
       
            }else{
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id'=> $user->id,
                    'password' => encrypt('123456dummy')
                ]);
      
                Auth::login($newUser);
      
                return redirect()->intended('dashboard');
            }
      
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
