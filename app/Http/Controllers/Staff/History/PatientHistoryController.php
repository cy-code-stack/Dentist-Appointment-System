<?php

namespace App\Http\Controllers\Staff\History;

use App\Http\Controllers\Controller;
use App\Models\PaymentAppointment;
use Illuminate\Http\Request;

class PatientHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $data = PaymentAppointment::where('user_id', $id)->with('services', 'appointment', 'user')->orderBy('created_at', 'desc')->get();
        return response()->json([
            'message' => 'Data display successfully.',
            'data' => $data,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
}
