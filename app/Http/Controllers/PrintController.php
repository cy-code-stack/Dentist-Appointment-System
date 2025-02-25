<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\PatientInformationRecord;
use App\Models\PaymentAppointment;
use App\Models\Services;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PrintController extends Controller
{
    public function downloadPrint(Request $request) {
        $appointment = Appointment::with('patient', 'appointServices')->find($request->id);
        $data = [
            'invoiceId' => $appointment->id,
            'services' => $appointment->appointServices,
            'patient' => $appointment->patient,
            'paymentAppointments' => $appointment->payment->where('user_id', $appointment->patient->id)->each(fn($item)=>$item->items),
        ];
        $pdf = Pdf::loadView('invoice', [...$data]);
        $filename = 'invoice_' . Str::random(10) . '.pdf';
        
        $path = public_path('invoices/' . $filename);
    
        if (!file_exists(public_path('invoices'))) {
            mkdir(public_path('invoices'), 0777, true);
        }
    
        file_put_contents($path, $pdf->output());
        return response()->json(['path' => url('invoices/' . $filename)]);
    }
    public function downloadPatientHistory(Request $request) {
        $history = PaymentAppointment::where('user_id', $request->id)->with('services')->get();
        $user = User::find($request->id);
        $data = [
            'history' => $history,
            'patient' =>  $user,
        ];

        $pdf = Pdf::loadView('patient-history', [...$data]);
        $filename = 'patient-history_' . Str::random(10) . '.pdf';
        
        $path = public_path('patient-history/' . $filename);
    
        if (!file_exists(public_path('patient-history'))) {
            mkdir(public_path('patient-history'), 0777, true);
        }
    
        file_put_contents($path, $pdf->output());
        return response()->json(['path' => url('patient-history/' . $filename)]);
    }

    public function printAppointmentHistory($id)
    {   
        $record = PatientInformationRecord::with('diagnostics', 'user')->find($id);
        $diagnostics = $record->diagnostics;
        $data = [
            'information'   =>  $record,
            'user'          =>  $record->user,
            'diagnostics'   =>  $diagnostics,
        ];

        $pdf = Pdf::loadView('print_appointment', [...$data])->setPaper('a4', 'portrait');

        $filename = 'print_appointment' . Str::random(10) . '.pdf';
        
        $path = public_path('print_appointment/' . $filename);
    
        if (!file_exists(public_path('print_appointment'))) {
            mkdir(public_path('print_appointment'), 0777, true);
        }
    
        file_put_contents($path, $pdf->output());
        return response()->json(['path' => url('print_appointment/' . $filename)]);
    }



    ## Dashboard Admin

    public function printPatientCount()
    {
        $records = DB::table('appointment as ap')
            ->select(DB::raw('MONTH(ap.created_at) as month'), DB::raw('COUNT(*) as count'))
            ->groupBy('month')
            ->get();

        $data = array_fill(1, 12, 0);
        foreach ($records as $record) {
            $data[intval($record->month)] = $record->count;
        }

        return $data;
    }

    public function printAppointmentPercentageEachMonth()
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

    public function printTopServicesEachAppointment()
    {
        return Services::select('services.id', 'services.services_name', DB::raw('COUNT(ap.services_id) as services_count'))
            ->join('appointment as ap', 'services.id', '=', 'ap.services_id')
            ->groupBy('services.id', 'services.services_name')
            ->orderByDesc('services_count')
            ->limit(5)
            ->get();
    }

    public function printSales()
    {
        $records = DB::table('payment_appointments as pa')
            ->select(
                DB::raw('MONTH(pa.created_at) as month'),
                DB::raw('SUM(pa.fee) as total_fee')
            )
            ->groupBy('month')
            ->get();
        
        $monthlyFees = array_fill(1, 12, 0);
        foreach ($records as $record) {
            $monthlyFees[(int)$record->month] = $record->total_fee;
        }
        
        return $monthlyFees;
    }

    public function printConsolidatedReport()
    {
        $data = [
            'patientCount' => $this->printPatientCount(),
            'appointmentPercentage' => $this->printAppointmentPercentageEachMonth(),
            'topServices' => $this->printTopServicesEachAppointment(),
            'salesData' => $this->printSales(),
        ];

        $pdf = Pdf::loadView('print_report', $data)->setPaper('a4', 'portrait');
        $filename = 'consolidated_report_' . Str::random(10) . '.pdf';
        $path = public_path('print_reports/' . $filename);

        if (!file_exists(public_path('print_reports'))) {
            mkdir(public_path('print_reports'), 0777, true);
        }

        file_put_contents($path, $pdf->output());
        return response()->json(['path' => url('print_reports/' . $filename)]);
    }

}
