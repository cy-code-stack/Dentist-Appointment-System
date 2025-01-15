<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Services;
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

    public function countAppointmentCatered(){
        $record = Appointment::where('appnt_status', '<>', 'Declined')->count();
        return response()->json([
            'status' => 'success',
            'data' => $record,
        ], 200);
    }

    public function countServices(){
        $record = Services::where('serv_status', 'Verified')->count();
        return response()->json([
            'status' => 'success',
            'data' => $record,
        ], 200);
    }
    public function countOngoingAppointment(){
        $record = Appointment::where('appnt_status', 'Pending')->count();
        return response()->json([
            'status' => 'success',
            'data' => $record,
        ], 200);
    }
    public function countDeclinedAppointment(){
        $record = Appointment::where('appnt_status', 'Declined')->count();
        return response()->json([
            'status' => 'success',
            'data' => $record,
        ], 200);
    }

    public function displayAppointment(Request $request)
    {
        $limit = $request->input('limit', 10);
        $page = $request->input('page', 1);
        $status = $request->input('status');

        $query = Appointment::with('patient', 'appointServices');

        if ($status) {
            $query->where('appnt_status', $status);
        }

        $records = $query->paginate($limit, ['*'], 'page', $page);

        return response()->json([
            'status' => 'success',
            'data' => $records->items(),
            'meta' => [
                'current_page' => $records->currentPage(),
                'last_page' => $records->lastPage(),
                'total' => $records->total(),
            ],
        ], 200);
    }
}
