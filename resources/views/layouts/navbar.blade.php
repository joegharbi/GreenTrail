<?php

    use Illuminate\Support\Facades\Route;

    function add_nav_item($route, $text, $is_highlight) {
        $nav_item = '<li class="nav-item';
        if (Route::currentRouteName() == $route) {
            $nav_item .= ' active';
        }
        $nav_item .= '"><a class="nav-link text-white rounded';
        if ($is_highlight) {
            $nav_item .= ' h5';
        }
        $nav_item .= '" href="' . route($route) . '">' . $text . '</a></li>';
        echo $nav_item;
    }

?>
<style>
    .nav-item.active > a {
        background-color: #146B42;
    }
    .nav-item > a:hover {
        background-color: #146B42;
    }
</style>
<div class="navbar navbar-expand-lg navbar-light bg-success">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">
            <img src="{{ asset('/logo.png')}}" width="60" height="57" alt="logo">
            </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                {{ add_nav_item('home', 'Home', true) }}
                @auth
                    {{ add_nav_item('dashboard', 'Dashboard', false) }}
                    {{ add_nav_item('calendar_dashboard', 'Calendar', false) }}
                    {{ add_nav_item('history', 'History', false) }}
                @endauth
                {{ add_nav_item('about-us', 'About Us', false) }}
                {{ add_nav_item('contact', 'Contact', false) }}
            </div>
        </div>
        @if (Route::has('login'))
                @auth
                <!-- Settings Dropdown -->
                <div class="ml-3 relative">
                    <x-jet-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                    <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                </button>
                            @else
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                                        {{ Auth::user()->name }}

                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Manage Account') }}
                            </div>

                            <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Profile') }}
                            </x-jet-dropdown-link>

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                                    {{ __('API Tokens') }}
                                </x-jet-dropdown-link>
                            @endif

                            <div class="border-t border-gray-100"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-jet-dropdown-link href="{{ route('logout') }}"
                                                     onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-jet-dropdown-link>
                            </form>
                        </x-slot>
                    </x-jet-dropdown>
                </div>
{{--                <a href="{{ route('logout')}}" class="btn btn-danger">Logout</a>--}}
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary p-2 m-2">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-danger p-2 m-2">Register</a>
                    @endif
                @endauth
        @endif
    </div>
</div>


