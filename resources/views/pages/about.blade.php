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
    height: 200px;
    background: #aaa;
  }
  </style>
<div class="container mt-5">
  <h2>Who are we ?</h2>
  <div class="row">
    <div class="col-sm-4">
      <h2>Green Trail Services</h2>
      <div class="row"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRyDV4wqGVaQ5ZI8G1EvzyOddKABmtWiyWZrA&usqp=CAU" class="rounded" alt="Cinque Terre"></div>
      <h3 class="mt-4">Partenar</h3>

      <p>Welcome to GreenTrail. Our web app is built with the main goal of reducing our CO2 footprint. It helps you choose your best and suitable way of transport based on some factors like weather and traffic data.</p>
       <div class="row">
        <div class=" col-5 m-2"><img src="members/2.jpg" class="rounded" alt="Cinque Terre"></div>

        <div class="  col-5 m-2"><img src="members/2.jpg" class="rounded" alt="Cinque Terre"></div>
       </div>

       {{--  --}}
    <div class="row">
      <div class="col-6"></div>
      <div class="col-6"></div>
    </div>
       {{--  --}}
      <ul class="nav nav-pills flex-column">
        <li class="nav-item">
          <a class="nav-link active" href="#">Useful Links</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
      </ul>
      <hr class="d-sm-none">
    </div>
    <div class="col-sm-8">
      <h2>Mission </h2>
      {{-- <h5> Dec 12, 2021</h5> --}}
      <div class="fakeimg row">According to  increaseing of air pollution, high values of CO2 in the air, it contribute to global warming and climate changes by trapping heat</div>
      <p>We Introduce our solution through our product  website which is free to use .</p>
      <p>Welcome to GreenTrail. Our web app is built with the main goal of reducing our CO2 footprint. It helps you choose your best and suitable way of transport based on some factors like weather and traffic data.</p>

      <h2 class="mt-5">Vision</h2>
      {{-- <h5> Dec 12, 2021</h5> --}}
      <div class="fakeimg row">application that will help the person to choose the more environmental friendly way of transportation depending on some factors
        (traffic, weather conditions) and recommending him/her with the best transportation tool to use </div>
        <h2 class="mt-5">Goals</h2>
        {{-- <h5> Dec 12, 2021</h5> --}}
        <div class="fakeimg row">The goal is to help the world ............. </div>
    </div>
  </div>
</div>

<hr>
<div class="row">
    <div class="col-4">
          <h4><b>Bouafia</b></h4>
          <img src= "members/1.jpg" class="rounded h-75 d-inline-block" alt="Cinque Terre">
          <p>Mentor & Engineer</p>
    </div>
    <div class="col-4">
        <h4><b>Al Kadiry Mohamad</b></h4>
        <img src= "https://image.cnbcfm.com/api/v1/image/106689818-1599150563582-musk.jpg?v=1630603757" class="rounded h-75 d-inline-block" alt="Cinque Terre">
        <p>Architect & Engineer</p>
    </div>
    <div class="col-4">
      <h4><b>Horvát Krisztofer Zoltán</b></h4>
      <img src= "{{ asset('members/HorvatKrisztoferZoltan.jpeg') }}" class="rounded h-75 d-inline-block" alt="Cinque Terre">
      <p>Engineer & Web API Specialist</p>
    </div>

    <div class="col-4">
      <h4><b>Ismael Shadi</b></h4>
      <img src= "https://image.cnbcfm.com/api/v1/image/106689818-1599150563582-musk.jpg?v=1630603757" alt="Cinque Terre" class="h-75 d-inline-block rounded">
      <p>Architect & Engineer</p>
    </div>

    <div class="col-4">
      <h4><b>Gharbi Youssef</b></h4>
      <img src= "{{ asset('members/YoussefGh.jpg') }}" alt="Cinque Terre" class=" rounded h-75 d-inline-block">
      <p>Architect & Engineer</p>
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

