<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Calendar') }}
        </h2>
    </x-slot>

    <!-- write code here -->
    <!-- JS -->

    @section('title', 'Calendar')
    <script src="{{asset('js/jQuery/jQuery-2.1.4.min.js')}}"></script>

    <div class="container">
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
    
</x-app-layout>