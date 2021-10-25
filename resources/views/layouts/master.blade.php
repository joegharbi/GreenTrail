<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Green Trail')</title>
    <link rel="stylesheet" href=" {{ asset('css/master.css') }} ">  
    {{-- assest starts from public/... --}}
  </head>
  <body>
    @include('layouts.navbar')
    @yield('content')
    @include('layouts.sidebar')
   
    {{-- @section('sidebar')
       <p> This sidebar shoud included at all page of code(layout.master) </p>
    @show --}}
  </body>
</html>