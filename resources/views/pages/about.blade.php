{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Green Trai</title>
</head>
<body>
    <h3> Welcome in about us page </h3>
</body>
</html> --}}
@extends('layouts.master')

@section('title', 'About us')

@section('content')
  <div class="container">
    {{-- <h1>{!! $page_name !!}</h1> --}}
    {{-- <p>{{ $page_description }}</p> --}}
{{-- @extends('layouts.footer') --}}
<style>
  .fakeimg {
    background: #aaa;
  }

  .text-justify {
    text-align: justify;
  }
  </style>
<div class="container mt-5">
  <div class="row">
    <div class="col-sm-4">
      <h2>GreenTrail Services<sup>©</sup></h2>
      <div class="row"><div class="col-12"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRyDV4wqGVaQ5ZI8G1EvzyOddKABmtWiyWZrA&usqp=CAU" class="rounded w-100" alt="Carbon footprint"></div></div>
      <h3 class="mt-4">Our Partner</h3>

      <p>We created this product as a university project at <b>Eötvös Loránd University</b> Informatics Faculty as part of the Software Technologies course. </p>
       <div class="row p-2">
        <div class="col-6"><img src="https://www.elte.hu/media/e0/7e/fd9de9f56a00c7b1ac6d68349b12db0286bb0f3055666964e21fcfcd3669/elte-cimer-thumb.jpg?v202011191744" class="rounded" alt="ELTE logo blue"></div>

        <div class="col-6"><img src="https://www.elte.hu/media/c8/74/10aa18b15f33cc6bad93687a97c9396bfe67a7c8f041616a98a7b429c0ed/default-logo-thumb.jpg?v202011191744" class="rounded" alt="ELTE logo white"></div>
       </div>

    <div class="row">
      <div class="col-6"></div>
      <div class="col-6"></div>
    </div>
      <ul class="nav nav-pills flex-column">
        <li class="nav-item">
          <a class="nav-link active" href="#">Partner Links</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="https://www.elte.hu/">Eötvös Loránd University</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="https://www.inf.elte.hu/">Informatics Faculty</a>
        </li>
      </ul>
      <hr class="d-sm-none">
    </div>
    <div class="col-sm-8">
      <h2>Welcome to GreenTrail</h2>
      <p>A free-to-use web app, that helps to choose the best and most suitable way of transport based on live weather and traffic data. With this, you can reduce your CO<sup>2</sup> footprint significantly.</p>
      
      <h2 class="mt-5">The problem</h2>
      <div class="fakeimg p-2 rounded">The increasing amount of air pollution causes high values of CO<sup>2</sup> in the atmosphere and contributes to global warming and climate changes by trapping heat.</div>
      <h5 class="mt-1">Did you know?</h5>
      <p>Transportation is one of the largest pollution sources.</p>
      
      <h2 class="mt-5">Our Mission</h2>
      <div class="fakeimg p-2 rounded">To encourage the usage of environmental-friendly transportation methods in order to reduce CO<sup>2</sup> emissions.</div>

      <h2 class="mt-5">Our Vision</h2>
      <div class="fakeimg p-2 rounded">A totally free and easy-to-use application, that helps people to plan their trips and to choose the most fitting alternative for their special needs.</div>

      <h2 class="mt-5">Our Goals</h2>
      <div class="fakeimg p-2 rounded">To create a product, that makes using low-carbon transportation methods appealing.</div>
    </div>
  </div>
</div>

<hr>
<div class="row">
    <div class="col-4">
      <h4><b>Bouafia</b></h4>
      <img src= "members/1.jpg" class="rounded h-75 d-inline-block" alt="Bouafia">
      <p>Mentor</p>
    </div>
    <div class="col-4">
      <h4><b>Al Kadiry Mohamad</b></h4>
      <img src= "https://image.cnbcfm.com/api/v1/image/106689818-1599150563582-musk.jpg?v=1630603757" class="rounded h-75 d-inline-block" alt="Al Kadiry Mohamad">
      <p>Idea owner, Architect & Engineer</p>
    </div>
    <div class="col-4">
      <h4><b>Horvát Krisztofer Zoltán</b></h4>
      <img src= "{{ asset('members/HorvatKrisztoferZoltan.jpeg') }}" class="rounded h-75 d-inline-block" alt="Horvát Krisztofer Zoltán">
      <p>Engineer & Web API Specialist</p>
    </div>

    <div class="col-4">
      <h4><b>Ismael Shadi</b></h4>
      <img src= "https://image.cnbcfm.com/api/v1/image/106689818-1599150563582-musk.jpg?v=1630603757" alt="Cinque Terre" class="h-75 d-inline-block rounded">
      <p>Developer & Spokesman</p>
    </div>

    <div class="col-4">
      <h4><b>Gharbi Youssef</b></h4>
      <img src= "{{ asset('members/YoussefGh.jpg') }}" alt="Cinque Terre" class="rounded h-75 d-inline-block">
      <p>Full-stack developer</p>
    </div>

    <div class="col-4">
      <h4><b>AL-Hitawi Mohammed</b></h4>
      <img src= "{{ asset('members/MohammedHit.jpg') }}" alt="Cinque Terre" class="h-75 d-inline-block  ">
      <p>Devloper & AI Specialist </p>
  </div>
    </div>

  </div>
@stop
{{-- parent directive --}}
@section('sidebar')
  This Is Sidebar From About us  Page
  {{-- 19/11/2021 --}}

  @parent
@endsection

@section('f-content')
@endsection

