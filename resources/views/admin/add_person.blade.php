<!DOCTYPE html>
<html lang="en">
  <head>
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

    <script>

        $(document).on("change", "#roles", function(e) {

            // console.log($(this).val());
            if($(this).val() ==""){

            }
                else if($(this).val() == "doctor"){

                    $("#name").show();
                    $("#phone").show();
                    $("#email").show();
                    $("#pass").show();
                    $("#age").hide();
                    $("#disease").hide();
                    $("#speciality").show();
                    $("#room").show();
                    $("#dept").show();
                    $("#edu").show();
                    $("#image").show();

                }
                else if($(this).val() == "nures"){
                    $("#name").show();
                    $("#phone").show();
                    $("#email").show();
                    $("#pass").show();
                    $("#age").hide();
                    $("#disease").hide();
                    $("#speciality").hide();
                    $("#room").hide();
                    $("#dept").show();
                    $("#edu").show();
                    $("#image").hide();
                }
                else if($(this).val() == "patient"){
                    $("#name").show();
                    $("#phone").show();
                    $("#email").show();
                    $("#age").show();
                    $("#disease").show();
                    $("#pass").hide();
                    $("#speciality").hide();
                    $("#room").hide();
                    $("#dept").hide();
                    $("#edu").hide();
                    $("#image").hide();
                }
                else{ //WordBoy

                    $("#name").show();
                    $("#phone").show();
                    $("#email").show();
                    $("#age").hide();
                    $("#disease").hide();
                    $("#pass").show();
                    $("#speciality").hide();
                    $("#room").hide();
                    $("#dept").show();
                    $("#edu").show();
                    $("#image").hide();
                }
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
            
            <h2>Add a Person</h2>

                <form  method="post" action="/create_person" enctype="multipart/form-data">
                @csrf
                <div style="padding:15px;">
                    <label> Select Roles</label>
                    <select style="color:black; aling:center;" name="roles" class="text-center"  id="roles" >
                        <option>----Select----</option>
                        <option value="doctor" > Doctor </option>
                        <option value="nures" > Nures </option>
                        <option value="wordboy" > Wordboy </option>
                        <option value="patient" > Patient</option>
                    
                    </select>
                    </div>

                    <div style="padding:15px;">

                    <div id="name">
                    <label> Name</label>
                    <input type="text" style="color: black;"  placeholder=" Name" name="name"/>
                        @error('name')
                        <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    </div>

                    <div style="padding:15px;">
                    <div id="phone">
                    <label> Phone</label>
                    <input type="text" style="color: black;"  placeholder=" Number " name="phone"/>
                    </div>
                        @error('phone')
                        <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div style="padding:15px;">
                    <div id="age">
                    <label > Age </label>
                    <input type="text" style="color: black;"  placeholder=" Age " name="age"/>
                    </div>
                    </div>

                    <div style="padding:15px;">
                    <div id="email">
                    <label > Email </label>
                    <input type="email" style="color: black;"  placeholder=" Email I'D " name="email"/>
                    </div>
                        @error('email')
                        <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    

                    <div style="padding:15px;">
                    <div id="pass">
                    <label> Password</label>
                    <input type="password" style="color: black;"  placeholder="Password " name="pass"/>
                    </div>
                    </div>


                    <div style="padding:15px;">
                    <div id="disease">
                    <label > Disease </label>
                    <input type="text" style="color: black;"  placeholder=" Disease " name="disease"/>
                    </div>
                    </div>

                    <div style="padding:15px;">
                    <div id="speciality">
                    <label> Speciality</label>
                    <select style="color:black; aling:center;"  class="text-center " name="speciality">
                        <option value="Null">----Select----</option>
                        <option value="skin"> Skin </option>
                        <option value="heart"> Heart </option>
                        <option value="eye"> Eye </option>
                        <option value="nose"> Nose</option>
                    
                    </select>
                    </div>
                    </div>

                    <div style="padding:15px;">
                    <div id="room">
                    <label> Room No</label>
                    <input type="text" style="color: black;"   placeholder="Room Number" name="room"/>
                    </div>
                    </div>

                    <div style="padding:15px;">
                    <div id="dept">
                    <label >Dept Name</label>
                    <input type="text" style="color: black;"  placeholder="Dept Name" name="dept"/>
                    </div>
                    </div>

                    <div style="padding:15px;">
                    <div id="edu">
                    <label> Education </label>
                    <input type="text" style="color: black;"   placeholder="Education" name="edu"/>
                    </div>
                    </div>

                   <div style="padding:15px;">
                   <div id="image">
                   <label> DR. Image </label>
                    <input type="file"   style="color: black;"  name="image"/>
                   </div>
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