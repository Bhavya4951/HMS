<!DOCTYPE html>
<html lang="en">
  <head>
  <base href="/public">
  @include('admin.css')
  
    <style>
        label{

            display: inline-block;
            width: 200px;
        }

        .error{
            margin-top: 10px;
            margin-left: 200px;
            font-size: 17px;
            
            color: red;
        }

        

    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      
      @include('admin.sidebar')
      <!-- partial -->
      @include('admin.navbar')
        <!-- partial -->




        <div class="container-fluid page-body-wrapper">
            <div class="container" align="cenetr" style="padding-top: 100px;">
            
           
            @if(session()->has('message'))
            <div class="alert alert-primary alert-dismissible fade show w-auto" role="alert">
                    {{ Session::get('message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
             </div>
            @endif
            <h2>Appointment Data</h2>

                <form  method="post" action="{{url('select_appointment_data',$approve->id)}}">
                @csrf

                    <div style="padding:15px;">

                    
                    <label> Select Data</label>
                    <input type="date" style="color: black;" height="200px" name="date"/>
                        @error('date')
                        <div class="error">{{ $message }}</div>
                        @enderror
                    
                    </div>

                    <input type="submit" value="Submit"  width="20px" class="btn btn-success"/>
                    </div>
                   
               
                </form>

                
            </div>
        </div>





    <!-- container-scroller -->
    <!-- plugins:js -->
      @include('admin.script') 
  </body>
</html>