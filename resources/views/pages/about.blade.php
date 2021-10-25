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
    <h1>{!! $page_name !!}</h1>
    <p>{{ $page_descrption }}</p>
  </div>
@stop
{{-- parent directive --}}
@section('sidebar')
  This Is Sidebar From About us  Page
  @parent
@endsection