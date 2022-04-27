<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <meta name="copyright" content="MACode ID, https://macodeid.com/">

  <title>One Health - Medical Center HTML5 Template</title>

  <link rel="stylesheet" href="../assets/css/maicons.css">

  <link rel="stylesheet" href="../assets/css/bootstrap.css">

  <link rel="stylesheet" href="../assets/vendor/owl-carousel/css/owl.carousel.css">

  <link rel="stylesheet" href="../assets/vendor/animate/animate.css">

  <link rel="stylesheet" href="../assets/css/theme.css">

  <style>
      .table{

       
     
        padding: 10px;
      }

  </style>
</head>
<body>

  <!-- Back to top button -->
  <div class="back-to-top"></div>

  @include('user.navbar')

 
<div class="table">
  <div class="main-panel">
    <div class="content-wrapper">    
        <div class="row innertable">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Appointment List</h4>
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
                            <th> Register date </th>
                            <th> Status </th>
                            <th> Appointment Date </th>
                            <th> Delete </th>
                           
                          </tr>
                        </thead>

                   
                    @foreach($appoint as $appoints)
                      
                <tbody>
                 
                          <tr>
                          <td> {{$appoints->id}} </td>
                            <td>
                                <span class="pl-2">{{$appoints->p_name}}</span>
                            </td>
                            <td> {{$appoints->disease}} </td>
                            <td> {{$appoints->p_phone}} </td>
                            <td> {{$appoints->p_email}} </td>
                            <td> {{$appoints->message}} </td>
                            <td> {{date('d/M/y',strtotime($appoints->a_date))}} </td>
                            <td> {{$appoints->status}} </td>
                            <td>{{date('d/M/y',strtotime($appoints->appointment_date))}}</td>
                            <td>
                              <a href="{{url('/delete_appoint',$appoints->id)}}" class="btn btn-outline-danger">Delete</a>
                            </td>
                           
                            
                          </tr>
                      
                        </tbody>
                        @endforeach
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
 </div>
 </div> 


  @include('user.footer')

  

<script src="../assets/js/jquery-3.5.1.min.js"></script>

<script src="../assets/js/bootstrap.bundle.min.js"></script>

<script src="../assets/vendor/owl-carousel/js/owl.carousel.min.js"></script>

<script src="../assets/vendor/wow/wow.min.js"></script>

<script src="../assets/js/theme.js"></script>
  
</body>
</html>