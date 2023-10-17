<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    @yield('css')
</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-light" style="background: rgb(174, 125, 35)">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
            </ul>
            <!-- Liens de la barre de navigation à gauche -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link p-0 pr-3" data-toggle="dropdown" href="#">
                        <img src="../../dist/img/user2-160x160.jpg" class='img-circle elevation-2' width="40"
                            height="40" alt="">
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-3">
                        <h4 class="h4">
                            <strong class="text-justify">{{ Auth::user()->last_name . ' ' . Auth::user()->first_name }}</strong>
                        </h4>
                        <hr>
                        <div class="dropdown-divider mt-1"></div>
                        <a href="{{route('user.profile')}}" class="dropdown-item">
                            <i class="fas fa-user-cog mr-2"></i> MOI
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fa fa-question-circle mr-3" aria-hidden="true"></i>FAQ
                        </a>
                        <div class="dropdown-divider"></div>
                        <form action="{{ route('logout') }}" method="POST" class="nav-link" id="logout">
                            @csrf
                            <i class="fas fa-sign-out-alt mr-2 text-danger"></i> <span>Déconnexion</span>
                        </form>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar elevation-4" style="background: rgb(174, 125, 35); color: #FFFFFF;">
            <div class="card bg-primary">
                <h5 class="text-center">Ma Tontine</h5>
            </div>
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item mt-3" style="margin-top: 10px;">
                            <a href="{{ route('dashboard.index') }}" class="nav-link" style="font-size: 20px;">
                                <i class="fas fa-tachometer-alt fa-lg" style="color: blue"></i>
                                <p class="text-white ml-2">Accueil</p>
                            </a>
                        </li>
                        <li class="nav-item mt-4 " style="margin-top: 10px;">
                            <a href="{{ route('tontine.index') }}" class="nav-link" style="font-size: 20px;">
                                <i class="fas fa-coins fa-lg" style="color: green"></i>
                                <p class="text-white ml-2">Tontine</p>
                            </a>
                        </li>
                        <li class="nav-item mt-4" style="margin-top: 10px;">
                            <a href="{{ route('user.index') }}" class="nav-link" style="font-size: 20px;">
                                <i class="fas fa-user fa-lg" style="color: blue"></i>
                                <p class="text-white ml-2">Participant</p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>@yield('title')</h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                @yield('content')
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer" style="background: rgb(174, 125, 35); color: #FFFFFF;">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 3.2.0
            </div>
            <strong>Tous droits réservés par Pteam - JonasDevPro 2023 &copy; {{ date('Y') }}</strong>
        </footer>
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#logout').click(function() {
                // Soumet le formulaire de déconnexion
                $('#logout').submit();
            });
        });
    </script>
    @yield('script')
</body>

</html>
