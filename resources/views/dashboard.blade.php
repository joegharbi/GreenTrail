@extends('layouts.master')

@section('title', 'Green Trail')

@section('content')

    <!-- write code here -->
    @section('title', 'Dashboard')

    <!-- css -->
    <style>
        .top_spacing{
            margin-top: 75px;
        }
        .frst_row{
            min-height: 500px;
        }
    </style>
    <!-- JS -->
    <script src="{{asset('js/jQuery/jQuery-2.1.4.min.js')}}"></script>

    <div class="container top_spacing">
        <div class="row frst_row">

            <!-- icluding CO2 counter -->
            <div class="col-md-6">
            @include('pages.history.carbon_counter')
            </div>
            
            <!-- including the hisotry table -->
            <div class="col-md-6">
            	
            @include('pages.calendar.calendar')
            </div>

        </div>
        
        <div class="row">  
            <!-- including the clendar-->
            <div class="col-md-6">
            @include('pages.history.history')
            </div>

            <!-- including the calendar table -->
            <div class="col-md-6">
            @include('pages.calendar.events')	
            </div>

        </div>
    </div>

   
@stop



