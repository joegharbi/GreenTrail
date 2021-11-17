<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <!-- write code here -->
    @section('title', 'Dashboard')

    <!-- css -->
    <style>
        .frst_row{
            min-height: 500px;
        }
    </style>
    <!-- JS -->
    <script src="{{asset('js/jQuery/jQuery-2.1.4.min.js')}}"></script>

    <div class="container">
        <div class="row frst_row">

            <!-- icluding CO2 counter -->
            <div class="col-md-5">
            @include('pages.history.carbon_counter')
            </div>
            
            <!-- including the hisotry table -->
            <div class="col-md-7">
            @include('pages.history.history')	
            </div>

        </div>
        
        <div class="row">  
            <!-- including the clendar-->
            <div class="col-md-5">
            @include('pages.calendar.calendar')
            </div>

            <!-- including the calendar table -->
            <div class="col-md-7">
            @include('pages.calendar.events')	
            </div>

        </div>
    </div>
    
</x-app-layout>

