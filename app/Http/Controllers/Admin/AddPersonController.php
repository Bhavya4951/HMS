<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User_Meta;
use App\Models\User; 
use Illuminate\Support\Facades\DB;

class AddPersonController extends Controller
{
    public function index(){

        return view('admin.add_person');
    }

    public function create(Request $request){


        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required'],
         
        ]);
        
        if($request->hasFile('image')){

            $destination_path = 'public/image';
            $image = $request->file('image');
            $image_name = $image->getClientOriginalName();
            $path = $request->file('image')->storeAs($destination_path,$image_name);
            
        }else{

            $path ="NULL";
        }

        $user = new User();
        $user_Meta = new User_Meta();
       
        $user->usertype = $request->roles;
        $user->name = trim($request->name);
        $user->phone =$request->phone;
        $user->email =$request->email;
        $password = $request->pass ? $request->pass : 'test';
        $user->password = Hash::make($password); 
        $user->save();
        $last_U_ID = User::orderBy('id', 'desc')->take(1)->first()->id;
       
       
        

        $data=array(

            "age"        => $request->age,
            "disease"    => $request->disease,
            "speciality" => $request->speciality?$request->speciality:"NULL",
            "room"       => $request->room,
            "dept"       => $request->dept,
            "education"  => $request->edu,
            "image"      => $path,
        );

        foreach($data as $key => $value) {
           
            DB::table('user_metas')->insert([
                'user_id'=>$last_U_ID,
                'meta_key'=>$key,
                'meta_value' => $value,  
            ]);
           
        }
        return redirect()->back()->with('message','Person Added Successfully');
    }
}
