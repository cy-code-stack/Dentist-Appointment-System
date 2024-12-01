@extends('layouts.master')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/Landing/landing.css') }}">
@endsection
@section('content')
    <section id="home">
        <div class="main-container container-fluid bg-primary">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid p-2">
                    <a class="navbar-brand d-flex align-items-center" href="/">
                        <img src="{{ asset('images/logo.png') }}" alt="logo-img" class="d-inline-block align-top" height="40">
                        <span class="ms-2 text-primary fw-medium">Graces Dental Clinic</span>
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
                        <div class="navbar-nav text-primary fw-medium">
                            <a class="nav-item nav-link active me-3" href="#home">Home</a>
                            <a class="nav-item nav-link me-3" href="#about_us">About</a>
                            <a class="nav-item nav-link me-3" href="#how_it_works">How it works</a>
                            <a class="nav-item nav-link me-3" href="#services">Services</a>
                            <a class="nav-item nav-link me-3" href="#inquiries">Inquiry</a>
                            <a class="nav-item nav-link" href="{{ route('signin') }}">Sign in</a>
                        </div>
                    </div>
                </div>
            </nav>
            <div class="landing_wrapper container-xl d-flex flex-column flex-lg-row align-items-center justify-content-center">
                <div class="text-container col-lg-6 mt-3 text-center text-lg-start">
                    <h1 class="fw-semibold mb-2 text-white display-4">Book your Online Appointment Now</h1>
                    <p class="text-white fs-6 mb-3">Welcome to Graces Dental Clinic, where scheduling appointments is simple and convenient. Whether you're an individual or anyone in need of our service, we've got you covered.</p>
                    <a href="{{ route('signin') }}" class="btn btn-light btn-lg">Get your appointment</a>
                </div>
                <div class="image-container col-lg-6 mt-3 text-center">
                    <img class="img-fluid" src="{{ asset('images/dentist.png') }}" alt="dentist">
                </div>
            </div>
        </div>
    </section>

    <section id="about_us" class="my-5">
        <div class="container-lg">
            <div class="row align-items-center">
                <!-- Text Section -->
                <div class="col-12 col-lg-7 mb-4 mb-lg-0">
                    <h1 class="text-uppercase mb-3 fw-bold">About Us</h1>
                    <p class="fs-6 lh-base text-muted">
                        Grace's Dental Clinic ensures effortless access to dental care with our user-friendly web appointment, allowing patients to schedule appointments conveniently from the comfort of their homes. Through our online portal, patients can select preferred appointment times, receive instant confirmation, and access important instructions for their visit. 
                    </p>
                    <p class="fs-6 lh-base text-muted">
                        Our reception staff is also dedicated to providing swift check-in and immediate assistance for walk-in patients, ensuring that everyone receives the care they need promptly and efficiently. Whether you book online or drop by spontaneously, expect top-notch care and minimal wait times at Grace's Dental Clinic.
                    </p>
                    <a href="{{ route('signin') }}" class="btn btn-primary btn-lg text-white mt-3">Get Your Appointment</a>
                </div>

                <!-- Image and Logo Section -->
                <div class="col-12 col-lg-5 text-center">
                    <img src="{{ asset('images/logo.png') }}" class="img-fluid mb-3" alt="Grace's Dental Clinic Logo" style="max-width: 300px;">
                    <h2 class="fw-bold">Grace's Dental Clinic</h2>
                </div>
            </div>
        </div>
    </section>

    <section id="how_it_works">
        <div class="container-lg mt-5">
            <div class="section-procedure">
                <h1 class="text-center mb-2" style="font-size: 4.5rem;">How it works!</h1>
                <p class="text-center">The appointment is simple yet effective. Just follow these steps to ensure your
                    appointment works well.</p>
            </div>
        </div>

        <div class="section-procedure-icon">
            <div class="container text-center">
                <div class="row justify-content-md-center">
                    <div class="col col-md-3">
                        <div class="step-icon d-flex justify-content-center align-items-center">
                            <div class="banner bg-primary d-flex justify-content-center align-items-center text-white">1</div>
                            <i class='bx bx-book'></i>
                        </div>
                    </div>
                </div>
                <div class="content text-center mt-5">
                    <h3 class="mb-2">Book an Appointment</h3>
                    <p class="fw-4">You can easily schedule appointments for any of our medical services without any
                        inconvenience.</p>
                </div>
            </div>

            <div class="text-center">
                <i class='bx bx-right-arrow-alt fs-1 fw-bold text-info'></i>
            </div>

            <div class="container text-center">
                <div class="row justify-content-md-center">
                    <div class="col col-md-3">
                        <div class="step-icon d-flex justify-content-center align-items-center">
                            <div class="banner bg-primary d-flex justify-content-center align-items-center text-white">2</div>
                            <i class='bx bx-envelope'></i>
                        </div>
                    </div>
                </div>
                <div class="content text-center mt-5">
                    <h3 class="mb-2">Receive an Email</h3>
                    <p class="fw-4">You'll receive a confirmation email with your appointment details shortly. Keep an eye on
                        your inbox.</p>
                </div>
            </div>

            <div class="text-center">
                <i class='bx bx-right-arrow-alt fs-1 fw-bold  text-info'></i>
            </div>


            <div class="container text-center">
                <div class="row justify-content-md-center">
                    <div class="col col-md-3">
                        <div class="step-icon d-flex justify-content-center align-items-center">
                            <div class="banner bg-primary d-flex justify-content-center align-items-center text-white">3</div>
                            <i class='bx bx-clinic'></i>
                        </div>
                    </div>
                </div>
                <div class="content text-center mt-5">
                    <h3 class="mb-2">Go to the clinic</h3>
                    <p class="fw-4">After receiving your confirmation email, head to the clinic at your scheduled time.</p>
                </div>
            </div>
        </div>
    </section>



    <section id="services" class="my-5">
        <div class="container-lg">
            <!-- Section Header -->
            <div class="text-center mb-4">
                <h1 class="fw-bold" style="font-size: 2.5rem;">Services</h1>
                <p class="text-muted">Our clinic offers a range of services designed to meet your needs.</p>
            </div>
        </div>

        <!-- Services Cards -->
        <div class="container">
            <div class="row g-4">
                <!-- Service Cards -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="card h-100">
                        <img src="{{ asset('images/animated-img/oral-prophylaxis-cleaning.png') }}" class="card-img-top" alt="Oral Prophylaxis Cleaning">
                        <div class="card-body text-center">
                            <h5 class="card-title">Oral Prophylaxis Cleaning</h5>
                            <p class="card-text text-muted">Thorough cleaning of teeth to remove plaque and tartar buildup, promoting oral hygiene and preventing gum disease.</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="card h-100">
                        <img src="{{ asset('images/animated-img/tooth-restoration.jpg') }}" class="card-img-top" alt="Tooth Restoration">
                        <div class="card-body text-center">
                            <h5 class="card-title">Tooth Restoration</h5>
                            <p class="card-text text-muted">Restoration of damaged or decayed teeth using durable and natural-looking materials to restore functionality and aesthetics.</p>
                            <p class="card-text fw-medium">Price Starts 700 pesos only</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="card h-100">
                        <img src="{{ asset('images/animated-img/tooth-extraction.jpg') }}" class="card-img-top" alt="Tooth Extraction">
                        <div class="card-body text-center">
                            <h5 class="card-title">Tooth Extraction</h5>
                            <p class="card-text text-muted">Safe and professional removal of damaged or problematic teeth to alleviate pain and prevent further oral health issues.</p>
                            <p class="card-text fw-medium">Price Starts 700 pesos only</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="card h-100">
                        <img src="{{ asset('images/animated-img/orthodontics-treatment.jpg') }}" class="card-img-top" alt="Orthodontics Treatment">
                        <div class="card-body text-center">
                            <h5 class="card-title">Orthodontics Treatment</h5>
                            <p class="card-text text-muted">Correction of teeth alignment issues using advanced orthodontic techniques to enhance both oral function and appearance.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4 mt-3">
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="card h-100">
                        <img src="{{ asset('images/animated-img/root-canal.jpg') }}" class="card-img-top" alt="Root Canal Treatment">
                        <div class="card-body text-center">
                            <h5 class="card-title">Root Canal Treatment</h5>
                            <p class="card-text text-muted">Specialized treatment to save and repair infected or damaged teeth, typically completed within 2 to 3 hours for efficient and effective care.</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="card h-100">
                        <img src="{{ asset('images/animated-img/jacket-crown.jpg') }}" class="card-img-top" alt="Jacket Crowns">
                        <div class="card-body text-center">
                            <h5 class="card-title">Jacket Crowns</h5>
                            <p class="card-text text-muted">Custom-made crowns to cover and protect damaged teeth, restoring their shape, size, and strength.</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="card h-100">
                        <img src="{{ asset('images/animated-img/teeth-whitening.jpg') }}" class="card-img-top" alt="Teeth Whitenings">
                        <div class="card-body text-center">
                            <h5 class="card-title">Teeth Whitening</h5>
                            <p class="card-text text-muted">Professional teeth whitening services to brighten and enhance the appearance of teeth, improving confidence and self-esteem.</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="card h-100">
                        <img src="{{ asset('images/animated-img/tooth-cleaning.jpg') }}" class="card-img-top" alt="Tooth Cleaning">
                        <div class="card-body text-center">
                            <h5 class="card-title">Tooth Cleaning</h5>
                            <p class="card-text text-muted">Regular dental cleaning to remove plaque and stains, ensuring optimal oral health and a fresh, clean smile.</p>
                            <p class="card-text fw-medium">Price Starts 700 pesos only</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <section id="inquiries" class="my-5">
        <div class="inquries-section container-lg w-100 p-3">
            <!-- Header Section -->
            <h1 class="text-center mb-2 fw-bold" style="font-size: 3rem;">Inquiries</h1>
            <p class="text-center mb-4 text-muted">Send us an inquiry using the form below and we will get back to you on time.</p>

            <!-- Inquiry Form Container -->
            <div class="main-inq-cont rounded-4 p-4 bg-light shadow">
                <form action="{{ route('inquiries.store') }}" method="POST">
                    @csrf
                    <!-- First Row -->
                    <div class="row g-3 mb-3">
                        <div class="col-12 col-md-6">
                            <label for="fname" class="form-label mb-1">Firstname</label>
                            <input type="text" class="form-control" name="fname" placeholder="Enter your firstname">
                            @error('fname')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="lname" class="form-label mb-1">Lastname</label>
                            <input type="text" class="form-control" name="lname" placeholder="Enter your lastname">
                            @error('lname')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                    </div>

                    <!-- Second Row -->
                    <div class="row g-3 mb-3">
                        <div class="col-12 col-md-6">
                            <label for="fblink" class="form-label mb-1">Facebook Link</label>
                            <input type="text" class="form-control" name="fblink" placeholder="Facebook link">
                            @error('fblink')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="email" class="form-label mb-1">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="email@gmail.com">
                            @error('email')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                    </div>

                    <!-- Third Row -->
                    <div class="row g-3 mb-3">
                        <div class="col-12">
                            <label for="phone" class="form-label mb-1">Contact Number</label>
                            <input type="text" class="form-control" name="cnumber" placeholder="09123456789">
                            @error('cnumber')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                    </div>

                    <!-- Message Section -->
                    <div class="mb-4">
                        <label for="message" class="form-label mb-1">Drop your concern here</label>
                        <textarea class="form-control" name="message" placeholder="Type your message" rows="6" style="resize: none;"></textarea>
                        @error('message')
                            <div class="text-danger"><small>{{ $message }}</small></div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary px-5">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </section>


    <div class="footer container-fluid bg-primary py-5 text-white">
        <div class="container">
            <div class="row gy-4">
                <!-- Logo and Basic Info -->
                <div class="col-12 col-lg-3 text-center text-lg-start">
                    <div class="logo-icon">
                        <img src="{{ asset('images/logo.png') }}" alt="logo-icon" class="img-fluid mb-3" style="max-width: 100px;">
                        <h4>Graces Dental Clinic</h4>
                        <p class="fs-6 fw-light lh-sm">
                            Office Hours: <br> Monday to Saturday <br> 8 am to 5 pm
                        </p>
                    </div>
                </div>

                <!-- Contact Info -->
                <div class="col-12 col-lg-5">
                    <div class="icon-text">
                        <p class="mb-2">
                            <i class='bx bx-clinic me-2'></i> Graces Dental Clinic
                        </p>
                        <p class="mb-2">
                            <i class='bx bx-current-location me-2'></i> Eleventh Street Business Complex, 2nd Floor,
                            National Highway, Purok 5, San Francisco Poblacion, Panabo, Davao del Norte, Philippines
                        </p>
                        <p class="mb-2">
                            <i class='bx bx-envelope me-2'></i> Oconrenegrace@gmail.com
                        </p>
                        <p class="mb-2">
                            <a href="https://www.facebook.com/DrGraceOconTabudlong" class="text-white text-decoration-none">
                                <i class='bx bxl-facebook-circle me-2'></i> Graces Dental Clinic
                            </a>
                        </p>
                        <p>
                            <i class='bx bx-phone-call me-2'></i> 092 9603 3673
                        </p>
                    </div>
                </div>

                <!-- Clinic Description -->
                <div class="col-12 col-lg-4 text-center text-lg-start">
                    <h3>Graces Dental Clinic</h3>
                    <p class="fs-6">
                        Grace's Dental Clinic ensures effortless access to dental care with our user-friendly web appointment system, allowing patients to schedule appointments conveniently from the comfort of their homes.
                    </p>
                </div>
            </div>
        </div>
    </div>


    <div class="card rounded-5 scroll-to-top-card">
        <a href="#home" class="scroll-to-top" id="scrollToTopBtn">
            <i class="fa-solid fa-arrow-up"></i>
        </a>
    </div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const navLinks = document.querySelectorAll('.nav-link');

        navLinks.forEach(link => {
            link.addEventListener('click', function () {
                // Remove 'active' class from all nav links
                navLinks.forEach(nav => nav.classList.remove('active'));
                
                // Add 'active' class to the clicked nav link
                this.classList.add('active');
            });
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const navLinks = document.querySelectorAll('.nav-link');
        const scrollToTopBtn = document.getElementById('scrollToTopBtn');
        const homeNavLink = document.querySelector('a[href="#home"]');

        window.addEventListener('scroll', function () {
            if (window.scrollY > 100) {
                scrollToTopBtn.style.display = 'block';
            } else {
                scrollToTopBtn.style.display = 'none';
            }
        });

        scrollToTopBtn.addEventListener('click', function (event) {
            event.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });

            if (homeNavLink) {
                navLinks.forEach(link => link.classList.remove('active'));
                homeNavLink.classList.add('active');
            }
        });

        navLinks.forEach(link => {
            link.addEventListener('click', function () {
                navLinks.forEach(nav => nav.classList.remove('active'));
                this.classList.add('active');
            });
        });
    });
</script>
@endsection
