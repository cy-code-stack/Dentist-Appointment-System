<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\PatientInformationRecord;
use App\Models\PaymentAppointment;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
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
            'paymentAppointments' => $appointment->payment->each(fn($item)=>$item->items),
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
        $record = PatientInformationRecord::where('id', $id)->with('diagnostics', 'user')->first();
        $diagnostics = $record->diagnostics->first();
        $data = [
            'information'   => $record,
            'user'          =>  $record->user,
            'teeths'         =>  $diagnostics->teeth,
            'diseases'       =>  $diagnostics->teethDisease,
        ];

        $pdf = Pdf::loadView('print_appointment', [...$data])->setPaper('a4', 'portrait');

        $filename = 'print_appointment' . Str::random(10) . '.pdf';
        
        $path = public_path('print_appointment/' . $filename);
    
        if (!file_exists(public_path('print_appointment'))) {
            mkdir(public_path('print_appointment'), 0777, true);
        }
    
        file_put_contents($path, $pdf->stream());
        return response()->json(['path' => url('print_appointment/' . $filename)]);
    }
}
