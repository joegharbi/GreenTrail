<!DOCTYPE html>
<html lang="en">
  <head>
      @yield('head')
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <link rel="icon" href="{{ asset('/logo.png') }}">
      <stylesheet>
          <!-- CSS AdminLTE -->
          <link rel="stylesheet" href="{{asset('css/AdminLTE.css')}}">
          <!-- Styles -->
          <link rel="stylesheet" href="{{ mix('css/app.css') }}">
          <!-- CSS only -->
          <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
          {{--          <!-- Fonts -->--}}
          {{--          <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">--}}
          <!-- Vehicle CSS -->
          <link rel="stylesheet" href="{{ asset('css/vehicles.css') }}">
        </stylesheet>
        <style>
        body {
            background: url("https://s3-us-west-2.amazonaws.com/s.cdpn.io/38816/image-from-rawpixel-id-2042508-jpeg.jpg");}</style>
      <!-- JavaScript Bundle with Popper -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
      <!-- Scripts -->
      <script src="{{ mix('js/app.js') }}" defer></script>
      @livewireStyles
      <title>
          @yield('title')
      </title>
  </head>
  <body>
        @include('layouts.navbar')
        <div class="container">
            @yield('content')
        </div>

        @include('layouts.footer')
        <div>
            @yield('f-content')
        </div>
  </body>
</html>
