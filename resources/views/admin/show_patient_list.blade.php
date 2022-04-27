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
  


<script>
   //=========================================== Category =================================
$(document).on("change", "#status_category", function(e){
 
    
      var search = $('#search').val();
      var status_category= $(this).val();
      
    
     
    $.ajaxSetup({


      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('data-link')
        },
    }); 
    
      $.ajax({
       type: 'GET', 
       //url: `admin/filter_data/${status_category}`,
       url:"admin/live_search/?status_category="+status_category+"&search="+search,
       success: function(response){
            console.log('success');
            $('.table tbody').html(response); 
        }
         
        }).done(function(response) {
          console.log(response)
      });
  });

  //=========================================== Search  BAR =================================


  $(document).ready(function(){

    var search = $('#search').val();
    var status_category= $('#status_category').val();
   
    function fetch_customer_data(search, status_category)
    {
     
        $.ajax({
          
                url:"admin/live_search/?status_category="+status_category+"&search="+search,
                method:'GET',
                data:{search:search,status_category:status_category},
                
                success:function(data)
                {
                  var str = data;
                  str.replace('com', '777');
                  console.log(str);
                  console.log(str);
                  console.log(str);
                  // clean_url =str.replace('COM', '777');
                 
                  // console.log( clean_url);
                  $('.table tbody').html(data.table_data);
                  $('#total_records').text(data.total_data);
                 
                },
                dataType : "html",
        })
    }
  
    $(document).on('keyup', '#search', function(){
        var search = $(this).val();
        var status_category= $('#status_category').val();
        
          fetch_customer_data(search, status_category);
    });

          
          
  });


</script>
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
                  <div class="col-sm-2">
                      <h4 class="card-title">Patient List</h4>
                      <a href="{{url('/fullcalendar')}}"><div class="icon-md mdi mdi-calendar-check text-white "></div></a>
                    </div>
                    <div class="col-sm-2">
                    Search Data : <span id="total_records"></span>
                    </div>
                        
                    <div class="col-sm-2">
                        <label> Select Status</label> 
                        </div>
                        
                        <div class="col-sm-2"> 
                        
                        <select style="color:black; aling:center ;" id="status_category" name="status_category" class="text-center" >
                            <option value="">----Select----</option>
                            <option value="In Progress " > In Progress </option>
                            <option value="Approved" > Approved </option>
                            <option value="Rejected" > Rejected </option>
                            <option value="Completed" > Completed</option>
                       </select>
                       </div>
                       
                       <div class="col-sm-4">
                        <div class="ml-5">
                      Search <input type="text" name="search" id="search" class="ml-2" placeholder="Search Name">
                      </div>
                       </div>
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
                      @if(!empty($get_patient_list))
                     
                          @foreach($get_patient_list as $get_patient_lists)
                      
                       
                          <tr>
                          <td> {{$get_patient_lists->id}} </td>
                            <td>
                                <span class="pl-2">{{$get_patient_lists->p_name}}</span>
                            </td>
                            <td> {{$get_patient_lists->disease}} </td>
                            <td> {{$get_patient_lists->p_phone}} </td>
                            <td> {{$get_patient_lists->p_email}} </td>
                            <td> {{$get_patient_lists->message}} </td>
                            <td> {{date('d/M/y',strtotime($get_patient_lists->a_date))}} </td>

                            @if ($get_patient_lists->status == "Approved")

                                 <td class="text-success"> {{$get_patient_lists->status}} </td>
                            @elseif ($get_patient_lists->status == "Rejected")
                                <td class="text-danger"> {{$get_patient_lists->status}} </td>
                           @elseif ($get_patient_lists->status == "In Progress")
                                <td class="text-primary"> {{$get_patient_lists->status}} </td>
                            @else
                                 <td class="text-warning"> {{$get_patient_lists->status}} </td>
                            @endif
                            <td>
                            <a href="{{url('approved',$get_patient_lists->id)}}"  title="Approved"><div class="icon-md mdi mdi-checkbox-marked-circle text-success ml-3"></div></a>
                            </td>
                            <td>
                              <a href="{{url('canceled',$get_patient_lists->id)}}" title="Rejected"><div class="icon-md mdi mdi-close text-danger ml-3"></div></a>
                            </td>
                            <td>
                              <a href="{{url('completed',$get_patient_lists->id)}}"  title="Complete"><div class="icon-md mdi mdi-clipboard-outline text-warning ml-3"></div></a>
                            </td>
                            <td>
                              <a href="{{url('sendmail',$get_patient_lists->id)}}" title="Send Mail"><div class="icon-md mdi mdi-gmail text-primary ml-3"></div></a>
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