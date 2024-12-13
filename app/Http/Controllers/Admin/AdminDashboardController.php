<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function index(){
        return view("Admin.AdminDashboard");
    }

    
    public function countPatient(){
        $records = DB::table('appointment as ap')
            ->select(DB::raw('DATE_FORMAT(ap.created_at, "%m") as month'),DB::raw('COUNT(*) as count'))
            ->groupBy('month')
            ->get();

        $data = array_fill(1,12,0);

        foreach($records as $record){
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
        return \App\Models\Services::select('services.id', 'services.services_name', DB::raw('COUNT(ap.services_id) as services_count'))
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
}
