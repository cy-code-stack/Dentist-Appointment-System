<?php

namespace App\Http\Controllers\Staff\Archieve;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;

class ArchieveController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function showArchieve()
    {
        $user = User::whereNotIn("role", ['Dentist', 'Assistant'])
                        ->where('status', '<>', 'verified')
                        ->get();
        return $user;
    }

    public function showAppointmentDeclined(){
        $decline = Appointment::where('appnt_status', '=', 'Declined')
                                ->with('patient', 'services')
                                ->get();

        return $decline;
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateArchieve(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request['status'] = 'verified';
        $user->update($request->all());

        return response()->json([
            'status' => 'success',
            'data' => $user,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
