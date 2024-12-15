<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

    public function markAsRead(Request $request)
    {
        $user = Auth::user();
        $notification = $user->notifications()->find($request->id);

        if ($notification) {
            $notification->markAsRead();
        }

        return response()->json(['success' => true]);
    }

    public function markAllRead()
    {
        $user = Auth::user();
        $user->unreadNotifications->markAsRead();

        return redirect()->back()->with('success', 'All notifications marked as read.');
    }

    public function adminIndex(){
        return view('Admin.AdminDashboard');
    }

    public function indexuserPatient(){
        return view('Patient.Booking_Appointment');
    }
}
