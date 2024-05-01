@extends('layouts.master')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/Landing/landing.css') }}">
@endsection
@section('content')
    <div class="main-container container-fluid bg-primary">
        <nav class="navbar bg-body-transparent p-2 mb-2">
            <div class="logo">
                <span class="navbar-brand mb-0 h1 ms-3"><img class="image-fluid me-2" src="{{ asset('images/logo.png') }}"
                        alt="logo-img"><span class="text-white">Graces Dental Clinic</span></span>
                <a class="nav-link me-4 text-white fw-medium" href="{{ route('signin') }}">Login</a>
            </div>
        </nav>
        <div class="container-xl d-flex align-items-center justify-content-center">
            <div class="col mt-3">
                <div class="col">
                    <h1 class="fw-semibold mb-2 text-white" style="font-size: 3rem;">Book your Online Appointment Now</h1>
                </div>
                <div class="col col-lg-11">
                    <p class="text-white fs-6 mb-3" style="text-align: justify;">Welcome to Graces Dental Clinic, where
                        scheduling appointments is simple and convenient.
                        Whether you're a individual, or anyone in needs our service,
                        we've got you covered.</p>
                </div>
                <div class="d-flex align-items-start">
                    <a href="{{ route('appointment') }}"><div class="btn btn-light btn-lg me-2">Get your appointment</div></a>
                </div>
            </div>
            <div class="col mt-3">
                <img class="image-fluid" src="{{ asset('images/dentist.png') }}" alt="dentist">
            </div>
        </div>
    </div>
    <div class="about-us d-flex align-items-center container-lg mb-5">
        <div class="col col-lg-7">
            <h1 class="text-uppercase mb-2">About us</h1>
            <p class="fs-6 text-break lh-base mb-2" style="color: rgb(102, 102, 102); text-align:justify;">Grace's Dental
                Clinic ensures effortless access to dental care with our user-friendly web appointment, allowing patients to
                schedule appointments conveniently from the comfort of their homes. Through our online portal, patients can
                select preferred appointment times, receive instant confirmation, and access important instructions for
                their visit. Our reception staff is also dedicated to providing swift check-in and immediate assistance for
                walk-in patients, ensuring that everyone receives the care they need promptly and efficiently. Whether you
                book online or drop by spontaneously, expect top-notch care and minimal wait times at Grace's Dental Clinic.
            </p>
            <a href="{{ route('appointment') }}"><div class="btn btn-info text-white btn-lg me-2">Get your appointment</div></a>
        </div>
        <div class="about-logo col col-lg-5 d-flex justify-content-center align-items-center">
            <img src="{{ asset('images/logo.png') }}" class="image-fluid" alt="brand-logo">
            <h2 class="text-center">Grace's Dental Clinic</h2>
        </div>
    </div>
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
                        <div class="banner bg-warning d-flex justify-content-center align-items-center text-white">1</div>
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
                        <div class="banner bg-warning d-flex justify-content-center align-items-center text-white">2</div>
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
                        <div class="banner bg-warning d-flex justify-content-center align-items-center text-white">3</div>
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

    <div class="services container-fluid d-flex flex-column align-items-center mb-5 min-vh-100">
        <div class="container-lg">
            <div class="section-procedure">
                <h1 class="text-center mb-2" style="font-size: 4.5rem;">Services</h1>
                <p class="text-center">Our clinic offers a range of services designed to meet your needs.</p>
            </div>
        </div>
        <div class="container-fluid text-white d-flex justify-content-center mb-4">
            <div class="card m-2">
                <img src="{{ asset('images/services/OralProphylaxisCleaning.png') }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Oral Prophylaxis Cleaning</h5>
                    <p class="card-text">Thorough cleaning of teeth to remove plaque and tartar buildup, promoting oral
                        hygiene and preventing gum disease.</p>
                </div>
            </div>
            <div class="card m-2">
                <img src="{{ asset('images/services/ToothRestoration.png') }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Tooth Restoration</h5>
                    <p class="card-text">Restoration of damaged or decayed teeth using durable and natural-looking materials
                        to restore functionality and aesthetics.</p>
                </div>
            </div>
            <div class="card m-2">
                <img src="{{ asset('images/services/tooth_extraction.png') }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Tooth Extraction</h5>
                    <p class="card-text">Safe and professional removal of damaged or problematic teeth to alleviate pain
                        and prevent further oral health issues.</p>
                </div>
            </div>
            <div class="card m-2">
                <img src="{{ asset('images/services/orthodontics_treatment.png') }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Orthodontics Treatment</h5>
                    <p class="card-text">Correction of teeth alignment issues using advanced orthodontic techniques to
                        enhance both oral function and appearance.</p>
                </div>
            </div>
        </div>
        <div class="container-fluid d-flex justify-content-center">
            <div class="card m-2">
                <img src="{{ asset('images/services/root_canal.png') }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Root Canal Treatment</h5>
                    <p class="card-text">Specialized treatment to save and repair infected or damaged teeth, typically
                        completed within 2 to 3 hours for efficient and effective care.</p>
                </div>
            </div>
            <div class="card m-2">
                <img src="{{ asset('images/services/jacket_crowns.png') }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Jacket Crowns</h5>
                    <p class="card-text">Custom-made crowns to cover and protect damaged teeth, restoring their shape,
                        size, and strength.</p>
                </div>
            </div>
            <div class="card m-2">
                <img src="{{ asset('images/services/teeth_whitening.png') }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Teeth Whitenings</h5>
                    <p class="card-text">Professional teeth whitening services to brighten and enhance the appearance of
                        teeth, improving confidence and self-esteem.</p>
                </div>
            </div>
            <div class="card m-2">
                <img src="{{ asset('images/services/tooth_cleaning.png') }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Tooth Cleaning</h5>   
                    <p class="card-text">Regular dental cleaning to remove plaque and stains, ensuring optimal oral health
                        and a fresh, clean smile.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="footer container-fluid">
        <div class="footer-nav d-flex justify-content-center align-items-center">
            <div class="logo-icon container row justify-content-center align-items-center col col-lg-2">
                <img src="{{ asset('images/logo.png') }}" alt="logo-icon">
                <h4 class="text-center text-white">Graces Dental Clinic</h4>
                <p class="fs-6 fw-light text-white text-center lh-sm">Office Hrs: Monday to Saturday 8 am to 5 pm </p>
            </div>
            <div class="col col-md-3">
                <div class="icon-text">
                    <i class='bx bx-clinic text-white'><span class="ms-2">Graces Dental Clinic</span></i>
                    <i class='bx bx-current-location text-white'><span class="ms-2 text-break">Eleventh Street Business
                            Complex, 2nd floor, National Highway, Purok 5, San Francisco Poblacion, Panabo, Davao del Norte,
                            Philippines</span></i>
                    <i class='bx bx-envelope text-white'><span class="ms-2">Oconrenegrace@gmail.com</span></i><br>
                    <a href="https://www.facebook.com/DrGraceOconTabudlong"><i
                            class='bx bxl-facebook-circle text-white fs-6'><span class="ms-2">Graces Dental
                                Clinic</span></i></a><br>
                    <i class='bx bx-phone-call text-white'><span class="ms-2">092 9603 3673</span></i>
                </div>
            </div>
            <div class="last-footer col col-lg-7">
                <h3 class="text-white">Graces Dental Clinic</h3>
                <p class="text-center text-white text-break fs-6">Grace's Dental Clinic ensures effortless access to dental
                    care with our user-friendly web appointment, allowing patients to schedule appointments conveniently
                    from the comfort of their homes.</p>
            </div>
        </div>
    </div>
@endsection
