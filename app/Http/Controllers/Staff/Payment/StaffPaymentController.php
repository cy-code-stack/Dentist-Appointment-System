<?php

namespace App\Http\Controllers\Staff\Payment;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\PaymentAppointment;
use App\Models\PaymentItem;
use App\Models\Services;
use Illuminate\Http\Request;

class StaffPaymentController extends Controller
{
    
    public function show($id)
    {
        $record = PaymentAppointment::where('user_id', $id)->with('appointment.appointServices', 'services')->get();
        return response()->json([
            'status' => 'success',
            'data' => $record,
        ], 200);
    }

    public function services(){
        $services = Services::where("serv_status", "Verified")->get();
        return response()->json([
            'status' => 'success',
            'data' => $services,
        ], 200);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $response = PaymentAppointment::create($data);
        return response()->json([
            'status' => 'success',
            'data' => $response,
        ], 200);
    }

    public function getPaymentHistory($id){
        $record = PaymentAppointment::with('items')->findOrFail($id);
        return response()->json([
            'status' => 'success',
            'data' => $record,
        ], 200);
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

        if($newbalance <= 0){
            $paymentAppointment->update([
                'status' => 'Already Paid',
            ]);
        }

        return response()->json([
            'status' => 'success',
            'data' => $record,
        ], 200);
    }
}
