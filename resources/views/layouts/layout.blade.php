<!doctype html>
<html lang="en">

<head>
    <link rel="icon" href="{{ asset('img/vet.png') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    {{-- Animted Css --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Datatables-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css" />
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css" />
    <title>@yield('title')</title>
</head>

<body class="bg-light">
    <div id="response"></div>
    <div class="loader-page"></div>
    <div class="container-fluid px-0">
        <nav class="navbar shadow-sm bg-white">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('img/paws.png') }}" alt="" width="40" height="40">
                </a>
                <div class="div d-flex justify-content-end g-3 align-items-center">
                    <img src="{{ asset('img/clinic.png') }}" alt="Avatar" class="avatar"
                        style="height: 40px; width: 40px;" />
                    <div class="dropdown px-1">
                        <button class="btn btn-outline-dark border-0 dropdown-toggle" type="button" id="dropOutCard"
                            data-bs-toggle="dropdown" aria-expanded="false">{{ Auth::user()->name }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end" aria-labelledby="dropOutCard">
                            <li>
                                <form action="login/singout" method="POST">
                                    @csrf
                                    <a class="dropdown-item text-primary text-white" href="#"
                                        onclick="this.closest('form').submit()" id="btn-salir">Cerrar
                                        sesion <i class="fas fa-sign-out-alt"></i></a>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

    </div>

    @yield('content')


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/spinner.js') }}"></script>

</body>

</html>
