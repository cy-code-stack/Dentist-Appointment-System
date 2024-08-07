<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Booking</title>
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel= "stylesheet"
        href= "https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel= "stylesheet"
        href= "https://maxst.icons8.com/vue-static/landings/line-awesome/font-awesome-line-awesome/css/all.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" type="image/png" href="{{ asset('images/doctor.png') }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    @vite('resources/sass/app.scss')
</head>

<body>
    <div class="wrapper" id="app">
        <nav class="main-header navbar navbar-expand bg-info sticky-md-top">
            <div class="header-nav col-lg-4">
                <ul class="navbar-nav">
                    <li class="nav-item d-flex justify-content-start">
                        <a href="{{ route('appointment') }}" class="nav-link ms-4 fw-medium text-white active me-2">Appointment Booking</a>
                        <router-link to="/user/patient/calendar/event" class="nav-link text-white me-2">Calendar View</router-link>
                        <router-link to="/user/patient/appointment" class="nav-link text-white">Appointments</router-link>
                    </li>
                </ul>
            </div>
            <div class="header-nav d-flex justify-content-end col-lg-8">
                <ul class="navbar-nav">
                    <li class="nav-item d-none d-sm-inline-block">
                        <div class="d-flex justify-content-center align-items-center me-2">
                            @if (Auth::check())
                                <span class="nav-link fw-medium text-white">{{ Auth::user()->firstname }}
                                    {{ Auth::user()->lastname }}</span>
                            @endif
                            <div class="dropstart">
                                <img src="{{ asset('images/logo.png') }}" alt="prof-img"
                                    class="profile-img img-fluid rounded-5 dropdown-toggle" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Profile</a></li>
                                    <li>
                                        <a href="{{ route('logout') }}" class="dropdown-item">
                                            <span class="name">Logout</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="content-wrapper">
            <router-view></router-view>
        </div>
    </div>

    @vite('resources/js/app.js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @include('sweetalert::alert')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js"
        integrity="sha512-+k1pnlgt4F1H8L7t3z95o3/KO+o78INEcXTbnoJQ/F2VqDVhWoaiVml/OEHv9HsVgxUaVW+IbiZPUJQfF/YxZw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>


<style>
    .profile-img {
        max-width: 50px;
        max-height: 50px;
        cursor: pointer;
        border: 1.5px solid white;
    }

    .dropdown-menu {
        margin-top: 4rem !important;
        margin-left: 1rem !important;
    }

    .calendar-link:active {
        color: var(--secondary-color);
    }

    .nav-link.active {
        background-color: #007bff; 
        color: #fff; 
        border-radius: 5px; 
    }

    .nav-link {
        transition: background-color 0.8s ease;
    }

</style>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const navLinks = document.querySelectorAll('.nav-link');

        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                navLinks.forEach(nav => nav.classList.remove('active'));

                this.classList.add('active');
            });
        });
    });
</script>

</html>
