<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Schedules') }}
        </h2>
    </x-slot>

    <!-- write code here -->

    @section('title', 'Calendar')

    @include('pages.calendar.events')

</x-app-layout>
