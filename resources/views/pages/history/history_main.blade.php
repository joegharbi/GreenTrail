<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('History') }}
        </h2>
    </x-slot>

    <!-- write code here -->

    @section('title', 'History')
    
    @include('pages.history.history')
    
</x-app-layout>