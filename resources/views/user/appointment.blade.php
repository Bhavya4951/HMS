<div class="page-section">
    <div class="container">
      <h1 class="text-center wow fadeInUp">Make an Appointment</h1>

          @if(session()->has('message'))
            <div class="alert alert-primary alert-dismissible fade show w-auto" role="alert">
                    {{ Session::get('message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
             </div>
            @endif


      <form class="main-form" method="post" action="{{url('/createAppointment')}}" >
      @csrf
        <div class="row mt-5 ">
          <div class="col-12 col-sm-6 py-2 wow fadeInLeft">
            <input type="text"  class="form-control" placeholder="Full name" autocomplete="true"  name="pname">
            @error('pname')
                <div class="error mt-2" style="color: red;">{{ $message }}</div>
           @enderror
          </div>
             
          <div class="col-12 col-sm-6 py-2 wow fadeInRight">
            <input type="text" class="form-control" placeholder="Disease" autocomplete="true"  name="disease">
            @error('disease')
                <div class="error mt-2" style="color: red;">{{ $message }}</div>
            @enderror
          </div>
          <div class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms">
            <input type="date" class="form-control" name="date">
            @error('date')
                <div class="error mt-2" style="color: red;">{{ $message }}</div>
            @enderror
          </div>
          <div class="col-12 col-sm-6 py-2 wow fadeInRight" data-wow-delay="300ms">
            <select  id="departement" class="custom-select text-center" name="drname">
           
            <option value="NULL">--- Select Doctor ---</option>
            @if(!empty($dr_name))
            @foreach ($dr_name as $names)
          
            <option value="{{$names->id}}"> {{ $names->name }}</option>
            @endforeach
            @else
              NO Founnd
            @endif
            </select>
          
          </div>
          

          <div class="col-12 col-sm-6 py-2 wow fadeInRight" data-wow-delay="300ms">
            <input type="text" class="form-control" placeholder="Number" autocomplete="true"  name="phone">
            @error('phone')
                <div class="error mt-2" style="color: red;">{{ $message }}</div>
            @enderror
          </div>
          <div class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms">
            <input type="email" class="form-control"  placeholder="Email ID"  autocomplete="false"  name="email">
            @error('email')
                <div class="error mt-2" style="color: red;">{{ $message }}</div>
            @enderror
          </div>


          <div class="col-12 py-2 wow fadeInUp" data-wow-delay="300ms">
            <textarea  id="message" class="form-control" rows="6" placeholder="Enter message.."   autocomplete="false"  name="message"></textarea>
            @error('message')
                <div class="error mt-2" style="color: red;">{{ $message }}</div>
            @enderror
         </div>
          <div class="col-12 text-center mt-4 wow zoomIn">
          <input type="submit"  style="background-color:black;"  value="Submit Request" class="btn btn-outline-success">
        </div>        
      </div>
        
      </form>
    </div>
  </div> <!-- .page-section -->