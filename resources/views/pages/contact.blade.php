@extends('layouts.master')

@section('title', 'Contact')

@section('content')
  <div class="container">     
    <!--Contact-us-->
  <section class="contact_us section-padding">
    <h2 class="m-1">Contact Us</h2>
    <div class="container">
      <div  class="row">
        <div class="col-md-6">
          <h3 class="m-1">Get in touch with us ..</h3>
            
          <div class="contact_form gray-bg">
            <form  method="post">
              <div class="form-group d-grid gap-3 p-1  border">
                <label class="control-label p-2 text-secondary">Type your's Name <span class="text-danger">*</span></label>
                <input type="text" name="fullname" class="form-control white_bg" id="fullname" required>
              </div>
              <div class="form-group d-grid gap-3 p-1  border text-secondary">
                <label class="control-label">Email Address <span class="text-danger">*</span></label>
                <input type="email" name="email" class="form-control white_bg" id="emailaddress" required>
              </div>
              <div class="form-group d-grid gap-3 p-1  border text-secondary">
                <label class="control-label">Phone Number <span class="text-danger">*</span></label>
                <input type="text" name="contactno" class="form-control white_bg" id="phonenumber" required>
              </div>
              <div class="form-group d-grid gap-3 p-1  border text-secondary">
                <label class="control-label">Message <span class="text-danger">*</span></label>
                <textarea class="form-control white_bg" name="message" rows="4" required></textarea>
              </div>
              <div class="form-group d-grid gap-3 p-1  border text-secondary">
                <button class="btn btn-primary" type="submit" value="submit">Send Message <span class="angle_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span></button>
                {{-- <button type="button" value="submit" class="btn btn-primary">Send Message</button> --}}
              </div>
            </form>
          </div>
        </div>
        <div class="col-md-1">
        </div>
        <div class="col-md-4 m-3">
          <h3 class="d-grid gap-3 p-2 m-1">Contact Informations</h3>
          <div class="contact_detail">
            <ul>
              <li class="row  m-2">
               <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-facebook col-2" viewBox="0 0 16 16">
               <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
              </svg>
              <P class="col-6"><a href="https://www.facebook.com/greentrail" class="text-decoration-none">Facebook Page </a></P>
            </li>
        
          
              <li class="row m-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-youtube col-2" viewBox="0 0 16 16">
                  <path d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.007 2.007 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.007 2.007 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31.4 31.4 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.007 2.007 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A99.788 99.788 0 0 1 7.858 2h.193zM6.4 5.209v4.818l4.157-2.408L6.4 5.209z"/>
                </svg>
              <P class="col-6"><a href="https://www.youtube.com/" class="text-decoration-none">Youtube Channel </a></P>
            </li>
       
          
            <li class="row m-2">
              <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-envelope-fill col-2" viewBox="0 0 16 16">
                <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555ZM0 4.697v7.104l5.803-3.558L0 4.697ZM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757Zm3.436-.586L16 11.801V4.697l-5.803 3.546Z"/>
              </svg>
              <P class="col-6"><a href="mailto:greentrail@greentrail.com" class="text-decoration-none"></a>greentrail@greentrail.com  </a></P>
          </li>
          
          
           <li class="row m-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-telephone-plus-fill col-2" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511zM12.5 1a.5.5 0 0 1 .5.5V3h1.5a.5.5 0 0 1 0 1H13v1.5a.5.5 0 0 1-1 0V4h-1.5a.5.5 0 0 1 0-1H12V1.5a.5.5 0 0 1 .5-.5z"/>
            </svg>
          <P class="col-6"><a href="tel:+964-770-0-0"></a>0036-1212-0000  </a></P>
        </li>
        
          
            <li class="row m-2">
              <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-linkedin col-2" viewBox="0 0 16 16">
                <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V6.169H2.542v7.225h2.401zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248-.822 0-1.359.54-1.359 1.248 0 .694.521 1.248 1.327 1.248h.016zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016a5.54 5.54 0 0 1 .016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225h2.4z"/>
              </svg>
            <P class="col-6"><a href="https://www.linkedin.com/" class="text-decoration-none">linkedin</a>  </a></P>
          </li>
          {{--  --}}

          {{--  --}}
              
          <li class="row m-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-github col-2" viewBox="0 0 16 16">
              <path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.012 8.012 0 0 0 16 8c0-4.42-3.58-8-8-8z"/>
            </svg>
          <P class="col-6"><a href="https://github.com/joegharbi/GreenTrail" class="text-decoration-none">GitHub</a>  </a></P>
        </li>
        
          
        <li class="row m-2">
          <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-share-fill col-2" viewBox="0 0 16 16">
            <path d="M11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.499 2.499 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5z"/>
          </svg>
        <P class="col-6"><a href="https://greentrail@greentrail.com" class="text-decoration-none">Share</a>  </a></P>
        </li>
      {{--  --}} 
              </ul>
          </div>
        </div>
      </div>
    </div>

    
  </section>
  <!-- /Contact-us--> 
{{-- footer --}}
@section('f-content')
@endsection  
    <script>
    let form = document.getElementsByTagName("form")[0];
form.addEventListener("submit", (e) => {
  e.preventDefault();
  alert(" Your meassge has been submited we will contact you as soon as possible !");
});
  </script>
@stop

