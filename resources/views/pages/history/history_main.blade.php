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

    @section('title', 'History')

    <div class="container top_spacing">
        @include('pages.history.history')
    </div>
    
@stop
