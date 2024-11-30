<?php

namespace App\Http\Controllers\Admin\Payments;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\PaymentAppointment;
use App\Models\PaymentItem;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $response = PaymentAppointment::create($data);
        return response()->json([
            'status' => 'success',
            'data' => $response,
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $record = PaymentAppointment::with('appointment')->get();
        return response()->json([
            'status' => 'success',
            'data' => $record,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function addPayment(Request $request){
        $data = $request->all();
        $paymentAppointment = PaymentAppointment::find($data['payment_appoitment_id']);
        $newbalance = (float) $paymentAppointment->balance - (float) $data['paid'];
        $data['new_balance'] = $newbalance;
        $record = PaymentItem::create($data);
        $paymentAppointment->update([
            'balance' => $newbalance
        ]);

        $appointmentbalance = PaymentAppointment::where('appointment_id', $paymentAppointment->appointment_id)->sum('balance');

        if($appointmentbalance <= 0){
            $appointmentbalance->status->update([
                'status' => 'Already Paid',
            ]);
            $appointment = Appointment::find($paymentAppointment->appointment_id);
            $appointment->update([
                'appnt_status' => 'Completed',
            ]);
        }

        return response()->json([
            'status' => 'success',
            'data' => $record,
        ], 200);
    }
    public function getPaymentHistory($id){
        $record = PaymentAppointment::with('items')->findOrFail($id);
        return response()->json([
            'status' => 'success',
            'data' => $record,
        ], 200);
    }
}
