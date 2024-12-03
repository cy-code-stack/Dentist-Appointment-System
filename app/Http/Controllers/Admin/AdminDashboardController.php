<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function index(){
        return view("Admin.AdminDashboard");
    }


    public function demographics(){
        $records = User::whereIn('sex', ['Male', 'Female'])->get();
        $maleCount = $records->where('sex', 'Male')->count();
        $femaleCount = $records->where('sex', 'Female')->count();

        return response()->json([
            'Male' => $maleCount,
            'Female' => $femaleCount,
        ]);
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
