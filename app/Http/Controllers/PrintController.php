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
        $appointment = Appointment::with('patient')->find($request->id);

        $data = [
            'invoiceId' => $appointment->id,
            'patient' => $appointment->patient,
            'paymentAppointments' => $appointment->payment()->with('items')->get(),
        ];
        $pdf = Pdf::loadView('invoice',[...$data]);
        $filename = 'invoice_' . Str::random(10) . '.pdf';
        $path = 'invoices/' . $filename;

        Storage::disk('public')->put($path, $pdf->output());

        // return  response()->download(storage_path($path));
        return response()->json(['path' => Storage::url($path)]);
    }
}
