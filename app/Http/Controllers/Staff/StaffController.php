<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $notifications = $user->notifications()->latest()->get();
        $unreadCount = $user->unreadNotifications->count();
        return view("Staff.staff", compact('notifications', 'unreadCount'));
    }
}
