<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('Staff.staff');
    }

    public function adminIndex(){
        return view('admin.AdminDashboard');
    }

    public function indexuserPatient(){
        return view('Patient.Booking_Appointment');
    }
}
