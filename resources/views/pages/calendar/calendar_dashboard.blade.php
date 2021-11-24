@extends('layouts.master')

@section('title', 'Green Trail')

@section('content')

    <!-- write code here -->
    <!-- css -->
    <style>
        .top_spacing{
            margin-top: 75px;
        }
    </style>

    <!-- JS -->

    @section('title', 'Calendar')
    <script src="{{asset('js/jQuery/jQuery-2.1.4.min.js')}}"></script>

    <div class="container top_spacing">
      <div class="row">

        <!-- including the clendar -->
        <div class="col-md-8">
          @include('pages.calendar.calendar')
        </div>

        <!-- including the calendar form -->
        <div class="col-md-4">
          @include('pages.calendar.event_form')
        </div>

      </div>
    </div>

@stop
