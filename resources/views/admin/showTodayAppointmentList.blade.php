<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<html lang="en">
  <head>
  @include('admin.css')
  <base href="/public">
<style>
  .innertable{
    margin-top: 10px;
    
  }
  .scroll{

      padding-left:0%;
  }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<meta name="csrf-token" data-link="{{ csrf_token() }}"/>
  


</head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      
      @include('admin.sidebar')
      <!-- partial -->
      @include('admin.navbar')
        <!-- partial -->
        <!-- <div class="container-fluid page-body-wrapper"> -->
            
<div class="main-panel">
    <div class="content-wrapper">    
        <div class="row innertable">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                  <div class="row">
                      <h4 class="card-title">Today Appointments</h4>
                      <a href="{{url('download')}}"><button style="margin-left: 700px;margin-bottom:10px; padding-bottom:15px;font-size:17px;" type="button" class="btn btn-success ">Download <i class="icon-md mdi mdi-arrow-collapse-down" style="font-size:20px;"> </i></button></a>
                    </div>
                    <div class="table-responsive scroll">
                      <table class="table">
                        <thead>
                          <tr>
                            <th> # </th>
                            <th> Patient Name </th>
                            <th> Disease </th>
                            <th> Number </th>
                            <th> Email </th>
                            <th> Message </th>
                            <th> Appointment Date </th>
                            <th> Status </th>
                            <th> Approved </th>
                            <th> Rejected </th>
                            <th> Complete </th>
                            <th> Send Mail</th>
                          </tr>
                        </thead>
                        <tbody>
                      

                        @if(!empty($today_apmt))
                     
                     @foreach($today_apmt as $today_apmts)
                 
                  
                     <tr>
                     <td> {{$today_apmts->id}} </td>
                       <td>
                           <span class="pl-2">{{$today_apmts->p_name}}</span>
                       </td>
                       <td> {{$today_apmts->disease}} </td>
                       <td> {{$today_apmts->p_phone}} </td>
                       <td> {{$today_apmts->p_email}} </td>
                       <td> {{$today_apmts->message}} </td>
                       <td> {{date('d/M/y',strtotime($today_apmts->a_date))}} </td>

                       @if ($today_apmts->status == "Approved")

                            <td class="text-success"> {{$today_apmts->status}} </td>
                       @elseif ($today_apmts->status == "Rejected")
                           <td class="text-danger"> {{$today_apmts->status}} </td>
                      @elseif ($today_apmts->status == "In Progress")
                           <td class="text-primary"> {{$today_apmts->status}} </td>
                       @else
                            <td class="text-warning"> {{$today_apmts->status}} </td>
                       @endif
                       <td>
                       <a href="{{url('approved',$today_apmts->id)}}"  title="Approved"><div class="icon-md mdi mdi-checkbox-marked-circle text-success ml-3"></div></a>
                       </td>
                       <td>
                         <a href="{{url('canceled',$today_apmts->id)}}" title="Rejected"><div class="icon-md mdi mdi-close text-danger ml-3"></div></a>
                       </td>
                       <td>
                         <a href="{{url('completed',$today_apmts->id)}}"  title="Complete"><div class="icon-md mdi mdi-clipboard-outline text-warning ml-3"></div></a>
                       </td>
                       <td>
                         <a href="{{url('sendmail',$today_apmts->id)}}" title="Send Mail"><div class="icon-md mdi mdi-gmail text-primary ml-3"></div></a>
                       </td>
                       
                     </tr>
                   @endforeach
                 @endif
                       </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
</div>
        </div>
        
    <!-- container-scroller -->
    <!-- plugins:js -->
      @include('admin.script') 
  </body>
</html>