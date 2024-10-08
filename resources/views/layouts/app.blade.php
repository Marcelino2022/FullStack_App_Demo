<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Pra-já Servir Angola</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://th.bing.com/th/id/OIP.FLZA1XVHArMTlpRvQogtDAAAAA?pid=ImgDet&rs=1">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md fixed-top" id="bg-header">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}"></a>
                <img src="https://th.bing.com/th/id/OIP.FLZA1XVHArMTlpRvQogtDAAAAA?pid=ImgDet&rs=1" class="logo" alt="Pra-Já">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        @auth
                            <li class="nav-item"><a class="nav-link" href="{{route('home')}}">Home</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{route('coordenacoes')}}">Secretariado</a></li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                  Membros
                                </a>
                                <ul class="dropdown-menu">
                                  <li><a class="dropdown-item" href="">JAAC</a></li>
                                  <li><a class="dropdown-item" href="#"> MAAC</a></li>
                                  <li><hr class="dropdown-divider"></li>
                                  <li><a class="dropdown-item" href="{{route('todos')}}">Todos os membros</a></li>
                                </ul>
                             </li>

                             <li class="nav-item"><a class="nav-link" href="{{route('permissoes.index')}}">Nível acesso</a></li>

                             <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                  Locais
                                </a>
                                <ul class="dropdown-menu">
                                  <li><a class="dropdown-item" href="/provincias">Províncias</a></li>
                                  <li><a class="dropdown-item" href="/municipios"> Municípios</a></li>
                                  <li><a class="dropdown-item" href="/localidades">Distrito ou Comuna</a></li>
      {{--                             <li><hr class="dropdown-divider"></li>
                                  <li><a class="dropdown-item" href="{{route('localidades')}}">Todos os Locais</a></li> --}}
                                </ul>
                             </li>

                             <li class="nav-item"><a class="nav-link" href="{{route('funcoes')}}">Funções</a></li>
                             <li class="nav-item"><a class="nav-link" href="{{route('categorias')}}">Categorias</a></li>

                        @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                 {{--    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a> --}}
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">

                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <img src="http://144.126.234.33/build/assets/Logo-Web.c641d56e.png" class="float-start avatar" alt="...">
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" id="" aria-labelledby="navbarDropdown">
                                    <div class="list-group">
                                        <a href="#" class="list-group-item list-group-item-action active" id="dropMenu" aria-current="true">
                                            <i class="bi bi-person"></i> {{ Auth::user()->name }}
                                            <auth-component email={{ Auth::user()->email }}></auth-component>
                                        </a>
                                        <a href="#" class="list-group-item list-group-item-action"><i class="bi bi-tools"></i> Perfil</a>
                                        <a class="list-group-item list-group-item-action disabled"><br></a>
                                        <a class="list-group-item list-group-item-action" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                            <i class="bi bi-power"></i>Terminar Sessão
                                        </a>
                                    </div>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
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
            @yield('content')
        </main>
    </div>
</body>
</html>
