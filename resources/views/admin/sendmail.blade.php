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
            <div class="alert alert-primary alert-dismissible fade show " role="alert">
                    {{ Session::get('message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
             </div>
            @endif
            
            <h2>Send Mail</h2>

                <form  method="post" action="{{url('email_send',$data->id)}}">
                @csrf

                    <div style="padding:15px;">

                    <div id="">
                    <label> Greenting</label>
                    <input type="text" style="color: black;"  name="greenting"/>
                        @error('greenting')
                        <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    </div>

                    <div style="padding:15px;">
                    <div id="">
                    <label> Body</label>
                    
                    <textarea  rows="5" cols="" name="body"></textarea>
                    </div>
                        @error('body')
                        <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div style="padding:15px;">
                    <div id="">
                    <label > Action Text </label>
                    <input type="text" style="color: black;"  Value="Click Here" name="actiontext"/>
                    </div>
                         @error('actiontext')
                        <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div style="padding:15px;">
                    <div id="">
                    <label > Action URL </label>
                    <input type="text" style="color: black;"  name="actionurl"/>
                    </div>
                         @error('actionurl')
                        <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div style="padding:15px;">
                    <div id="">
                    <label > Endpart </label>
                    <input type="text" style="color: black;"   name="endpart"/>
                    </div>
                        @error('endpart')
                        <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                   <div style="padding:15px;">

                    
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