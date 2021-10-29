@extends('layouts.master')

@section('title', 'Contact Me')

@section('content')
  <div class="container">
    <h1>{!! $page_name !!}</h1>
    <p>{{ $page_descrption }}</p>
  </div>
@stop
{{-- parent directive --}}
@section('sidebar')
  This Is Sidebar From Contact us  Page
  @parent
@endsection