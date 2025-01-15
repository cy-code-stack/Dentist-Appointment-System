<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\PaymentAppointment;
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
            'services' => $appointment->appoint_services,
            'patient' => $appointment->patient,
            'paymentAppointments' => $appointment->payment()->with('items')->get(),
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
}
