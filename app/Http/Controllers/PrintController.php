<?php

namespace App\Http\Controllers;

use App\Models\PaymentAppointment;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PrintController extends Controller
{
    public function downloadPrint(Request $request) {
        $record = PaymentAppointment::with('paymentItems', 'appointment')->find($request->id);
        $pdf = Pdf::loadView('invoice', compact('record'));
        $filename = 'invoice_' . Str::random(10) . '.pdf';
        $path = 'invoices/' . $filename;
        Storage::disk('public')->put($path, $pdf->output());
        return response()->json(['path' => Storage::url($path)]);
    }
}
