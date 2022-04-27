<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User_Meta;
use App\Models\User;


class UserController extends Controller
{
    public function index(){
       
        $dr_name = DB::table('users')
        ->select('id','name')
        ->where('usertype','doctor')
        ->get();

         $data = DB::table('user_metas')
            ->join('users', function($join){
            $join->on('user_metas.user_id', '=', 'users.id');
            })
            ->select('user_metas.meta_key', 'user_metas.meta_value', 'users.name')
            ->where('usertype', '=', 'doctor')
            ->WhereIn('meta_key', ['image', 'speciality'])
            
            ->get();
        
        return view('user.user_home',compact('dr_name','data'));
    }

    // public function getDoctorsImage(){ //get image and show on user side
        
                   
        // $data = DB::table('user_metas')
        //     ->join('users', function($join){
        //     $join->on('user_metas.user_id', '=', 'users.id');
        //     })
        //     ->select('user_metas.meta_key', 'user_metas.meta_value', 'users.name')
        //     ->where('usertype', '=', 'doctor')
        //     ->WhereIn('meta_key', ['image', 'speciality'])
            
        //     ->get();


      //$image = User_Meta ::select('meta_value')->get();
    //   
    // return view('user.user_home',compact('data'));
      
    

    
}

?>
