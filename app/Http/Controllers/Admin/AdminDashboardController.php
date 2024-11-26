<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
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
        //this would be the sales report dashboard
    }
}
