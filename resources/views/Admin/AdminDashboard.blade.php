<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('images/logo.png') }}" rel="icon">
    <title>Admin</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel= "stylesheet"
        href= "https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('/css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    @vite('resources/sass/app.scss')

</head>


<body class="hold-transition sidebar-mini overflow-auto">
    <div class="wrapper" id="app">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light sticky-md-top">
            <ul class="navbar-nav">
                {{-- <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" role="button"><i
                            class="fas fa-bars"></i></a>
                </li> --}}
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="/user/admin/dashboard" class="nav-link ms-4">Admin Dashboard</a>
                </li>
            </ul>
        </nav>
        <aside class="main-sidebar sidebar-light-primary elevation-1 fixed-start">
            <a href="/user/admin/dashboard" class="brand-link text-decoration-none">
                <img src="{{ asset('images/logo.png') }}" alt="school logo" class="brand-image img-circle elevation-3"
                    style="opacity: .8">
                <span
                    class="brand-text fw-bold fs-6">Grace Dental Clinic</span>
            </a>
            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('images/logo.png') }}"
                            alt="school logo" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        @if (Auth::check())
                            <span class="fw-medium">{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</span> <br>
                            <span style="color:#a5a5a5"><small>{{ Auth::user()->role }}</small></span>
                        @endif
                    </div>
                </div>
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <router-link to="/user/admin/dashboard" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/user/admin/staff" class="nav-link">
                                <i class="nav-icon fa-solid fa-clipboard-user"></i>
                                <p>Manage Staff</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="" class="nav-link">
                                <i class="nav-icon fa-solid fa-hospital-user"></i>
                                <p>Refer Patients</p>
                            </router-link>
                        </li>
                        {{-- <li class="nav-item">
                            <router-link to="/admin/patient" class="nav-link">
                                <i class="nav-icon fa-solid fa-people-roof"></i>
                                <p>Manage Users</p>
                            </router-link>
                        </li> --}}
                        {{-- <li class="nav-item">
                            <router-link to="/admin/staff" class="nav-link">
                                <i class="nav-icon fa-solid fa-user-nurse"></i>
                                <p>Manage Staff</p>
                            </router-link>
                        </li> --}}
                        <li class="nav-item">
                            <router-link to="/user/admin/services" class="nav-link">
                                <i class="nav-icon fa-solid fa-list-check"></i>
                                <p>Manage Services</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/user/admin/trasanction" class="nav-link">
                                <i class="nav-icon fa-solid fa-notes-medical"></i>
                                <p>Transaction History</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/user/admin/sales" class="nav-link">
                                <i class="nav-icon fa-solid fa-chart-bar"></i>
                                <p>Sales Reports</p>
                            </router-link>
                        </li>
                        {{-- <li class="nav-item">
                            <router-link to="/admin/logs" class="nav-link">
                                <i class="nav-icon fa-regular fa-folder-open"></i>
                                <p>Logs</p>
                            </router-link>
                        </li> --}}
                        <li class="nav-item">
                            <router-link to="/user/admin/profile" class="nav-link">
                                <i class="nav-icon fa-solid fa-id-badge"></i>
                                <p>
                                    Profile
                                </p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('logout') }}" class="nav-link">
                                <div class="linknav">
                                    <i class="nav-icon fa-solid fa-right-from-bracket"></i>
                                    <span class="name">Logout</span>
                                </div>
                            </a>
                        </li>
                    </ul> 
                </nav>
            </div>
        </aside>
        <div class="content-wrapper">
            {{-- content vue here --}}
            <router-view></router-view>
        </div>
    </div>

    @vite('resources/js/app.js')
    {{-- <script src="{{ asset('/js/app.js') }}"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @include('sweetalert::alert')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js" integrity="sha512-+k1pnlgt4F1H8L7t3z95o3/KO+o78INEcXTbnoJQ/F2VqDVhWoaiVml/OEHv9HsVgxUaVW+IbiZPUJQfF/YxZw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>
