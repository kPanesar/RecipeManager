<!DOCTYPE html>
<html>
  <head>
      <meta charset="utf-8">
      <meta name="csrf-token" content="{{ csrf_token() }}">

      <title>Personal Recipe Manager</title>

      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
      <link href="https://fonts.googleapis.com/css?family=Fira+Sans:300,400,700" rel="stylesheet">
      <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}">

  </head>
  <body>
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    Recipe Manager
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                @if(Auth::check())
                    {{--Code for logged in user--}}

                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        <li><a href="{{ url('recipes') }}">My Recipes</a></li>
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="">Hello User!</a></li>
                        <li>
                            <a href="{{ url('/logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>

                @else
                    {{--Code for visitor--}}

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="{{url('login')}}">Log In</a></li>
                    </ul>
                @endif

            </div>
        </div>
    </nav>

    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="https://code.jquery.com/ui/1.11.3/jquery-ui.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <div class="container-fluid">
        @yield('content')
    </div>

    <script src="{{ asset('js/app.js') }}"></script>

  </body>
</html>
