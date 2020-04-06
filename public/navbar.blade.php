

  <nav class="navbar navbar-inverse">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Ads') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <ul class="nav navbar-nav">
                <li class="{{Request::is('home') ? 'active' : ''}}"><a href="{{asset('home')}}">Home</a></li>
                <li class="{{Request::is('categories') ? 'active' : ''}}"><a href="{{asset('categories')}}">Categories</a></li>
                <li class="{{Request::is('cities') ? 'active' : ''}}"><a href="{{asset('cities')}}">Cities</a></li>
                <li class="{{Request::is('ads') ? 'active' : ''}}"><a href="{{asset('ads')}}">Ads</a></li>
                <li class="{{Request::is('pages') ? 'active' : ''}}"><a href="{{asset('pages')}}">Pages</a></li>
              
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <ul class="dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <li><a class="dropdown-item" href="{{asset('home')}}">Home</a>  </li>

                                <li><a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>  </li>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            
                        </div>
                    </ul>
                @endguest
            </ul>
        </div>
    </div>
</nav>