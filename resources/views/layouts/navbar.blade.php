<div class="navbar navbar-expand-lg navbar-light bg-success">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">
            <img src="{{ asset('public/logo.png')}}" width="60" height="57" alt="logo">
            </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
               <span class="-ml-px">
                   <h6><a class="nav-link active text-white" aria-current="page" href="/">Home</a></h6>
               </span>
                <a class="nav-link text-white" href="{{route("about-us")}}">About</a>
                <a class="nav-link text-white" href="{{route("contact")}}">Contact</a>
            </div>
        </div>
        @if (Route::has('login'))
                @auth
                    <a href="{{ url('#') }}" class="btn btn-primary">History</a>
                    <a href="{{ url('#')}}" class="btn btn-danger">Logout</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary p-2 m-2">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-danger p-2 m-2">Register</a>
                    @endif
                @endauth
        @endif
    </div>
</div>


