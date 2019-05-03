<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ESHOP</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


</head>
<body>

    <style>

    .flex-container {
        display: flex;
        justify-content: center; 
    }
    
    .flex-container > div {
        background-color: #f1f1f1;
        width: 100px;
        margin: 10px;
        text-align: center;
        line-height: 75px;
        font-size: 30px;
    }

  /* Shrink */
  .shrink {
    display: inline-block;
    -webkit-transition-duration: 0.3s;
    transition-duration: 0.3s;
    -webkit-transition-property: transform;
    transition-property: transform;
    -webkit-transform: translateZ(0);
    transform: translateZ(0);
    box-shadow: 0 0 1px rgba(0, 0, 0, 0);
  }
  .shrink:hover, .shrink:focus, .shrink:active {
    -webkit-transform: scale(0.9);
    transform: scale(0.9);
  }
 
  
  
  /* Wobble Vertical */
  @-webkit-keyframes wobble-vertical {
    16.65% {
      -webkit-transform: translateY(8px);
      transform: translateY(8px);
    }
  
    33.3% {
      -webkit-transform: translateY(-6px);
      transform: translateY(-6px);
    }
  
    49.95% {
      -webkit-transform: translateY(4px);
      transform: translateY(4px);
    }
  
    66.6% {
      -webkit-transform: translateY(-2px);
      transform: translateY(-2px);
    }
  
    83.25% {
      -webkit-transform: translateY(1px);
      transform: translateY(1px);
    }
  
    100% {
      -webkit-transform: translateY(0);
      transform: translateY(0);
    }
  }
  
  @keyframes wobble-vertical {
    16.65% {
      -webkit-transform: translateY(8px);
      transform: translateY(8px);
    }
  
    33.3% {
      -webkit-transform: translateY(-6px);
      transform: translateY(-6px);
    }
  
    49.95% {
      -webkit-transform: translateY(4px);
      transform: translateY(4px);
    }
  
    66.6% {
      -webkit-transform: translateY(-2px);
      transform: translateY(-2px);
    }
  
    83.25% {
      -webkit-transform: translateY(1px);
      transform: translateY(1px);
    }
  
    100% {
      -webkit-transform: translateY(0);
      transform: translateY(0);
    }
  }
  
  .wobble-vertical {
    display: inline-block;
    -webkit-transform: translateZ(0);
    transform: translateZ(0);
    box-shadow: 0 0 1px rgba(0, 0, 0, 0);
  }
  .wobble-vertical:hover, .wobble-vertical:focus, .wobble-vertical:active {
    -webkit-animation-name: wobble-vertical;
    animation-name: wobble-vertical;
    -webkit-animation-duration: 1s;
    animation-duration: 1s;
    -webkit-animation-timing-function: ease-in-out;
    animation-timing-function: ease-in-out;
    -webkit-animation-iteration-count: 1;
    animation-iteration-count: 1;
  }
  
  
  /* Buzz */
  @-webkit-keyframes buzz {
    50% {
      -webkit-transform: translateX(3px) rotate(2deg);
      transform: translateX(3px) rotate(2deg);
    }
  
    100% {
      -webkit-transform: translateX(-3px) rotate(-2deg);
      transform: translateX(-3px) rotate(-2deg);
    }
  }
  
  @keyframes buzz {
    50% {
      -webkit-transform: translateX(3px) rotate(2deg);
      transform: translateX(3px) rotate(2deg);
    }
  
    100% {
      -webkit-transform: translateX(-3px) rotate(-2deg);
      transform: translateX(-3px) rotate(-2deg);
    }
  }
  
  .buzz {
    display: inline-block;
    -webkit-transform: translateZ(0);
    transform: translateZ(0);
    box-shadow: 0 0 1px rgba(0, 0, 0, 0);
  }
  .buzz:hover, .buzz:focus, .buzz:active {
    -webkit-animation-name: buzz;
    animation-name: buzz;
    -webkit-animation-duration: 0.15s;
    animation-duration: 0.15s;
    -webkit-animation-timing-function: linear;
    animation-timing-function: linear;
    -webkit-animation-iteration-count: infinite;
    animation-iteration-count: infinite;
  }
  

    </style>

    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Puerto Cell
                </a>
                
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                                @if (Route::has('register'))
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Registrarse') }}</a>
                                @endif
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->nombre }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @if( Auth::user()->tipo_usuario == "AD" )
                                    
                                    <a class="dropdown-item" href="/categories/index">
                                        Categorias
                                    </a>

                                    <a class="dropdown-item" href="/products/index">
                                        Productos
                                    </a>

                                    
                                    <a class="dropdown-item" href="/records">
                                        Historial de Compras
                                    </a>

                                    @elseif( Auth::user()->tipo_usuario == "CL" )

                                    @if($carritos > 0 )
                                    <a class="dropdown-item" href="/cart">
                                        Carrito <span class="badge badge-primary badge-pill"> {{$carritos}} </span>
                                    </a>
                                    @else
                                    
                                    <a class="dropdown-item" href="/cart">
                                        Carrito
                                    </a>
                                    @endif

                                    <a class="dropdown-item" href="/history">
                                        Historial
                                    </a>

                                     <a class="dropdown-item" href="/estadistics">
                                        Estadisticas
                                    </a>

                                    @endif
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
        @guest
            @yield('content')
        @else
            @if( Auth::user()->tipo_usuario == "AD" )
                @yield('contentA')
            
            @elseif( Auth::user()->tipo_usuario == "CL" )
                @yield('contentC')
            @endif

        @endif

        </main>
    </div>
</body>
</html>
