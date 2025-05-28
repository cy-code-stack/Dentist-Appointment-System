<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Services;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function index(){
        $user = Auth::user();
        $notifications = $user->notifications()->latest()->get();
        $unreadCount = $user->unreadNotifications->count();
        return view("Admin.AdminDashboard", compact('notifications', 'unreadCount'));
    }

    
    public function countPatient()
    {
        $records = DB::table('appointment as ap')
            ->select(DB::raw('MONTH(ap.sched_date) as month'), DB::raw('COUNT(*) as count'))
            ->whereNotNull('ap.sched_date')
            ->groupBy(DB::raw('MONTH(ap.sched_date)'))
            ->get();

        $data = array_fill(1, 12, 0);

        foreach ($records as $record) {
            $data[intval($record->month)] = $record->count;
        }

        return $data;
    }

    public function getAppointmentPercentageEachMonth()
    {
        $percentages = DB::table('appointment as ap')
            ->select(
                DB::raw('MONTH(ap.sched_date) as month'),
                DB::raw('COUNT(ap.id) as total_appointments'),
                DB::raw('ROUND((COUNT(ap.id) / (SELECT COUNT(*) FROM appointment) * 100), 2) as percentage')
            )
            ->groupBy(DB::raw('MONTH(ap.sched_date)'))
            ->get();

        $data = array_fill(1, 12, 0);

        foreach ($percentages as $percentage) {
            $data[intval($percentage->month)] = $percentage->percentage;
        }

        return $data;
    }


    public function getTopServicesEachAppointment()
    {
        return Services::select('services.id', 'services.services_name', DB::raw('COUNT(ap.services_id) as services_count'))
                    ->join('appointment as ap', 'services.id', '=', 'ap.services_id')
                    ->groupBy('services.id', 'services.services_name')
                    ->orderByDesc('services_count')
                    ->limit(5)
                    ->get();
    }




    public function sales(){
        $records = DB::table('payment_appointments as pa')
            ->select(
                DB::raw('DATE_FORMAT(pa.created_at, "%m") as month'),
                DB::raw('SUM(pa.fee) as total_fee')
            )
            ->groupBy('month')
            ->get();
        
        $monthlyFees = array_fill(1, 12, 0);

        foreach ($records as $record) {
            $monthIndex = (int)$record->month;
            $monthlyFees[$monthIndex] = $record->total_fee;
        }

        return $monthlyFees;
    }

    public function patientCount(){
        $record = User::where('role', 'Patient')->count();
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

    public function countTransaction(){
        $record = Appointment::where('appnt_status', 'Completed')->count();
        return response()->json([
            'status' => 'success',
            'data' => $record,
        ], 200);
    }

    public function assistantCount(){
        $record = User::where('role', 'Assistant')->count();
        return response()->json([
            'status' => 'success',
            'data' => $record,
        ], 200);
    }
}
