<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\User; 
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Exports\AppointmentExport;
use App\Models\NotificationsBall; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AppointmentAdmitExport;
use App\Notifications\SendMailNotification;
use Illuminate\Support\Facades\Notification;
use App\Notifications\AppointmentDateNotifaction;

class AppointmentController extends Controller
{

    public function createAppointment(Request $request){
        
        $validated = $request->validate([
            'pname' => ['required', 'string', 'max:255'],
            'disease' => ['required', 'string', 'max:255'],
            'date' => ['required'],
            'drname' => ['required'],
            'phone' => ['required','min:10','numeric'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'message' => ['required'],
         
        ]);

        $Apntmt = new Appointment();

        $Apntmt->dr_id = $request->drname;
        $Apntmt->p_name = trim($request->pname);
        $Apntmt->disease = $request->disease;
        $Apntmt->p_phone = $request->phone;
        $Apntmt->p_email = $request->email;
        $Apntmt->message = $request->message;
        $Apntmt->status = "In Progress";
        $Apntmt->a_date = $request->date;
        $Apntmt->save();

        $Apntmt_id= Appointment::get();
        //dd($Apntmt->id);
        $cnlntfctn = new NotificationsBall();
        $cnlntfctn->p_id=$Apntmt->id;
        $cnlntfctn->save();
        return redirect()->back()->with('message','Your  Appointment is Successfully Forward');
    }

    public function getPatientData(){ //Specific Doctor Show the Appontment list
        $id = Auth::user()->id;
       
        if( Auth::user()->usertype == 'doctor' ){
            $get_patient_list = Appointment::where('dr_id',$id)->get();
        } else {
            $get_patient_list = Appointment::all();
          
        }

        return view('admin.show_patient_list',compact('get_patient_list'));
    }



    public function approved($id){
      
        $approve = Appointment::find($id);

        $approve->status="Approved";
        $approve->save();
        $approve = Appointment::find($id);
        return view('admin.appointment_date',compact('approve'));
        //return redirect()->back();
    }

    public function select_appointment_data(Request $request,$id){
        $appointment_data = Appointment::find($id);

        $email_user = DB::table('appointments')->select('p_name', 'appointment_date')->find($id);
       
        $date= date("d/m/Y", strtotime( $email_user->appointment_date));

       // dd($date);
        $validated = $request->validate([
            'date' => ['required','after:yesterday'],   
        ]);
        $appointment_data ->appointment_date = $request->date;
        $appointment_data -> save();

        $details=[

            'greeting'=> $email_user->p_name,
            'body'=> 'Hello '.$email_user->p_name.' Your Appointment is Successfully Approved on that date '.$date,
            
            'endpart'=>"Thank you for Appointment",

        ];

         Notification::route('mail', 'bhavyakumarpanchotiya2014@gmail.com')
            ->notify(new AppointmentDateNotifaction($details));

       return redirect()->back()->with('message',' Appointment Date Successfully ');
    }



    public function completed($id){
      
        $approve = Appointment::find($id);

       
        $approve->status="Completed";
        //$approve->appointment_date="0000-00-00";
        $approve->save();
        return redirect()->back();
    }

    public function canceled($id){
      
        $approve = Appointment::find($id);

        
        $approve->status="Rejected";
        $approve->save();
        $Apntmt = new Appointment();
       
        return redirect()->back();
    }

    public function user_show_myappointment(){


            if(Auth::id()){

                    $doct_id = Auth::user()->id;
                    
                    $appoint = Appointment::where('dr_id',$doct_id)->get();
                          
                return view('user.user_show_myappointment',compact('appoint'));
            }else{

                return redirect()->back();
            }
            
    }

    public function delete_appoint($id){

        $approve = Appointment::find($id);
        $approve->delete();
        return redirect()->back();
    }
    
    public function sendmail($id){

        $data = Appointment::find($id);
        return view('admin.sendmail',compact('data'));

    }


    public function email_send(Request $request,$id){

        $data = Appointment::find($id);
       // dd($data);
        $validated = $request->validate([
            'greenting' => ['required', 'string', 'max:255'],
            'body' => ['required'],
            'actiontext' => ['required'],
            'actionurl' => ['required','url'],
            'endpart' => ['required'],
        ]);

        
        $details=[

            'greeting'=> $request->greenting,
            'body'=> $request->body,
            'actiontext'=> $request->actiontext,
            'actionurl'=> $request->actionurl,
            'endpart'=> $request->endpart,

        ];

         Notification::route('mail', 'bhavyakumarpanchotiya2014@gmail.com')
            ->notify(new SendMailNotification($details));
           
       
        return redirect()->back()->with('message','Email Send it');
    }


    public function live_search(Request $request)
    {
  
     if($request->ajax())
     {
         $output = '';

                $status_category=json_decode(json_encode($request->status_category));
                $search=json_decode(json_encode($request->search));

             if ($status_category != '' && $search!= '' )
                {
                    $dr_id = Auth::user()->id;

                    if(Auth::user()->usertype == 'doctor' ){
                           
                            $data =  DB::table('appointments')
                            ->where('status', $status_category,)
                            ->Where('p_name', 'like', '%'.$search.'%')
                            ->where('dr_id',$dr_id)
                             ->get();

                         }
                    else if(Auth::user()->usertype == '1'){
                           $data =  DB::table('appointments')
                           ->where('status', $status_category,)
                           ->Where('p_name', 'like', '%'.$search.'%')                        
                           ->get();
                    }
            
                }

            else if($status_category != ''){
               
                $dr_id = Auth::user()->id;

                    if(Auth::user()->usertype == 'doctor' ){
                       
                        
                        $data =  DB::table('appointments')
                        ->where('status', $status_category)
                        ->where('dr_id',$dr_id)
                        ->get();
                       
                    }
                    else if(Auth::user()->usertype == '1'){

                        $data =  DB::table('appointments')
                        ->where('status', $status_category)
                        ->get();
                    }
                }

            else if($search!= '' ){
               
                $dr_id = Auth::user()->id;

                    if(Auth::user()->usertype == 'doctor' ){
                        $data =  DB::table('appointments')
                        ->Where('p_name', 'like', '%'.$search.'%')
                        ->where('dr_id',$dr_id)
                        ->get();
                    }
                    else if(Auth::user()->usertype == '1'){
                        $data =  DB::table('appointments')
                        ->Where('p_name', 'like', '%'.$search.'%')
                        ->get();
                    }
                   
                }

            else{
                    $data= DB::table('appointments')->get();
                  
                   Log::channel('ERROR')->debug($data);  
                }
        
        $total_row = $data->count();
       
       
        if($total_row > 0)
        {
          
                foreach($data as $row)
                {
                    $url1 ='approved/'.$row->id;
                    $url2 ='canceled/'.$row->id;
                    $url3 ='completed/'.$row->id;
                    $url4 ='sendmail/'.$row->id;
                    
                  
                    $output .='<tr>'.
                        '<td>'.$row->id.
                        '<td>'.$row->p_name.
                        '<td>'.$row->disease.
                        '<td>'.$row->p_phone.
                        '<td>'.$row->p_email.
                        '<td>'.$row->message.
                        '<td>'.$row->status.
                        '<td>'.$row->a_date.
                        // dd('<td> <a href='. $url.'><div class=badge badge-outline-warning>Approved');
                        '<td> <a href='. $url1.'><div class=badge badge-outline-warning>Approved'.
                        '<td> <a href='.$url2.'><div class= badge badge-outline-danger>Rejected'.
                        '<td> <a href='.$url3.'><div class=badge badge-outline-success>Completed'.
                        '<td> <a href='.$url4.'><div class= badge badge-outline-primary>Send Mail'.

                        '<tr> ';

                       
                }
           
        }
        else {
            $output = '<tr>'.
                '<td Style="color:red; text-align:center;" colspan="12">No Data Found'.
                '<tr> ';
        }

       
        $data = array(
        'table_data'  => $output,
        'total_data'  => $total_row
        );

        
        
        return json_encode($data);
     }
    }

    public function todayAppointment(){ //Specific Doctor Show the  Today Appontment list
        
        $id = Auth::user()->id;
       
        
        if( Auth::user()->usertype == 'doctor' ){
          
            $today_apmt = DB::table('appointments')
            ->where('dr_id',$id)
            ->whereDate('created_at', carbon::today())->get();
  
            
        } else {
            $today_apmt = DB::table('appointments')
            ->whereDate('created_at', carbon::today())->get();
            
          
        }

        return view('admin.showTodayAppointmentList',compact('today_apmt'));
       
    }

    public function countAppointmenr(){ //Count Appointment

        $id = Auth::user()->id;
       
        
            if( Auth::user()->usertype == 'doctor' ){
                
               
               $today_apmt = Appointment::where('dr_id',$id)->whereIn('status', ['Rejected', 'Approved','In Progress'])->whereDate('created_at', carbon::today())->get();
               
              $count_apmt = $today_apmt->count();
               
               
               return view('admin.admin_home',compact('count_apmt'));
                
            } 
               
            
            $today_apmt = Appointment::whereIn('status', ['Rejected', 'Approved','In Progress'])->whereDate('created_at', carbon::today())->get();
               
              $count_apmt = $today_apmt->count();
               
              // dd($count_apmt);
               return view('admin.admin_home',compact('count_apmt'));
                       
           }

        public function notifaction(){
        
            $id = Auth::user()->id;
       
        
            if( Auth::user()->usertype == 'doctor' ){

                    $output = '';
                    $data= DB::table('notifications_balls')->select('p_id')
                    ->join('appointments', 'notifications_balls.p_id', '=', 'appointments.id')
                    ->where('dr_id',$id)
                    ->select('appointments.p_name','notifications_balls.id')
                    ->whereDate('appointments.created_at', carbon::today())
                    ->where('flag','0')
                    ->get();
                
                    if($data->count() > 0)
                        foreach ($data as  $key => $value) {
                        
                        
                            $url ='cnlnotifaction/'.$value->id;
                            
                        $date=  Carbon::now()->addSeconds(5)->diffForHumans();
                            $output .="<a style='margin:20px; color:white; font-size:15px; text-decoration: none; padding:0px' href=". $url.'> <div class=preview-item-content pl-5 ><p class=preview-subject dropdown-divider mb-1 >'.ucfirst($value->p_name)."<a><p><p style='margin-left:20px ; padding-bottom:5px;' class='text-muted ellipsis mb-0'>".$date;
                            
                            }
                    else{
                        $output.="<p style='margin-left:50px; font-size:15px; color:red;'> No Notifaction Today";

                    }
            }
        else{
                $output = '';
                $data= DB::table('notifications_balls')->select('p_id')
                ->join('appointments', 'notifications_balls.p_id', '=', 'appointments.id')
                ->select('appointments.p_name','notifications_balls.id')
                ->whereDate('appointments.created_at', carbon::today())
                ->where('flag','0')
                ->get();
            
                if($data->count() > 0)
                    foreach ($data as  $key => $value) {
                    
                    
                        $url ='cnlnotifaction/'.$value->id;
                        $date= Carbon::now()->addSeconds(5)->diffForHumans();
                        $output .="<a style='margin:20px; color:white; font-size:15px; text-decoration: none; padding:0px' href=". $url.'> <div class=preview-item-content pl-5 ><p class=preview-subject dropdown-divider mb-1 >'.ucfirst($value->p_name)."<a><p><p style='margin-left:20px ; padding-bottom:5px;' class='text-muted ellipsis mb-0'>".$date;
                        
                        }
                else{
                    $output.="<p style='margin-left:50px; font-size:15px; color:red;'> No Notifaction Today";

                }
            }
        return json_encode($output);
        }


    public function cnlnotifaction($id){


        $cnlntfctn = NotificationsBall::find($id);
       
        $cnlntfctn->flag="1";
       
        $cnlntfctn->save();
        
        return redirect()->route('todayAppointment');
    }

    public function download(){

        $id = Auth::user()->id;
       
        
        if( Auth::user()->usertype == 'doctor' ){
            return Excel::download(new AppointmentExport($id), 'Appointment.xlsx');
        }
        else{

            return Excel::download(new AppointmentAdmitExport(), 'Appointment(admin).xlsx');
        }
       
    }

    
}
