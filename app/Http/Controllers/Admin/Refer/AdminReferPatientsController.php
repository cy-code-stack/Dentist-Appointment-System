<?php

namespace App\Http\Controllers\Admin\Refer;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AdminReferPatientsController extends Controller
{
    public function getVerifiedPatients(){
        $verifiedPatients = Appointment::whereNotIn('appnt_status', ['Archive', 'Pending', 'Declined'])
                                            ->with('services', 'patient')
                                            ->get();
        
        return response()->json([
            'status' => 'success',
            'data' => $verifiedPatients,
        ], 200);
    }

    public function archiveReferPatients(Request $request, $id){
        $archiveRefer = Appointment::findOrFail($id);
        $request['appnt_status'] = 'Archive';
        $archiveRefer->update($request->all());

        return response()->json([
            'status' => 'success',
            'data' => $archiveRefer,
        ], 200);
    }
}
