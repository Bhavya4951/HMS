<div class="page-section">
    <div class="container">
      <h1 class="text-center mb-5 wow fadeInUp">Our Doctors</h1>
      <div class="owl-carousel wow fadeInUp" id="doctorSlideshow">
      
          @if(!empty($data))
          @foreach($data as $images)
          
          <div class="item">
          <div class="card-doctor">
          <div class="header">
          @if($images->meta_key == 'image')
          
         
          <img src='{{ Storage::get($images->meta_value)}}' alt='Not Found'>
          
            @endif
            
              <div class="meta">
                
                @if($images->meta_key == 'speciality')   
                <a href="#"><span class="mai-logo-whatsapp">{{$images->meta_value}}</span></a>
                <a href="#"><span class="mai-call">Dr.{{$images->name}}</span></a>
                @endif
              </div>
             </div>

            <div class="body">
              <p class="text-xl mb-0"></p>
              <span class="text-sm text-grey"></span>
            </div>

          </div>
        </div>
        @endforeach
        
        @endif
        <!-- <div class="item">
          <div class="card-doctor">
            <div class="header">
              <img src="{{ Storage::path('abcd.jpg') }}" alt="">
              <div class="meta">
                <a href="#"><span class="mai-call"></span></a>
                <a href="#"><span class="mai-logo-whatsapp"></span></a>
              </div>
            </div>
            <div class="body">
              <p class="text-xl mb-0">Dr. Alexa Melvin</p>
              <span class="text-sm text-grey">Dental</span>
            </div>
          </div>
        </div> -->
        <!-- <div class="item">
          <div class="card-doctor">
            <div class="header">
              <img src="../assets/img/doctors/doctor_3.jpg" alt="">
              <div class="meta">
                <a href="#"><span class="mai-call"></span></a>
                <a href="#"><span class="mai-logo-whatsapp"></span></a>
              </div>
            </div>
            <div class="body">
              <p class="text-xl mb-0">Dr. Rebecca Steffany</p>
              <span class="text-sm text-grey">General Health</span>
            </div>
          </div>
        </div> -->
        <!-- <div class="item">
          <div class="card-doctor">
            <div class="header">
              <img src="../assets/img/doctors/doctor_3.jpg" alt="">
              <div class="meta">
                <a href="#"><span class="mai-call"></span></a>
                <a href="#"><span class="mai-logo-whatsapp"></span></a>
              </div>
            </div>
            <div class="body">
              <p class="text-xl mb-0">Dr. Rebecca Steffany</p>
              <span class="text-sm text-grey">General Health</span>
            </div>
          </div>
        </div> -->
        <!-- <div class="item">
          <div class="card-doctor">
            <div class="header">
              <img src="../assets/img/doctors/doctor_3.jpg" alt="">
              <div class="meta">
                <a href="#"><span class="mai-call"></span></a>
                <a href="#"><span class="mai-logo-whatsapp"></span></a>
              </div>
            </div>
            <div class="body">
              <p class="text-xl mb-0">Dr. Rebecca Steffany</p>
              <span class="text-sm text-grey">General Health</span>
            </div>
          </div>
        </div> -->
      </div>
    </div>
  </div>