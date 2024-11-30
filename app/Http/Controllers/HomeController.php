<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $notifications = $user->notifications()->latest()->get();
        $unreadCount = $user->unreadNotifications->count();
        return view("Staff.staff", compact('notifications', 'unreadCount'));
    }

    public function adminIndex(){
        return view('admin.AdminDashboard');
    }

    public function indexuserPatient(){
        return view('Patient.Booking_Appointment');
    }
}
