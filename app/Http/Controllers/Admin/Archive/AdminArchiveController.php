<?php

namespace App\Http\Controllers\Admin\Archive;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Services;
use App\Models\User;
use Illuminate\Http\Request;

class AdminArchiveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Display the specified resource.
     */
    public function showStaffArchive()
    {
        $user = User::whereNotIn('role', ['Dentist', 'Patient'])->where('status', 'archive')->get();

        return response()->json([
            'status' => 'success',
            'data' => $user,
        ], 200);
    }

    public function showReferArchive(){
        $refer = Appointment::whereNotIn('appnt_status', ['Declined', 'Pending Approval', 'Completed', 'Pending'])->with('patient', 'appointServices')->get();

        return response()->json([
            'status' => 'success',
            'data' => $refer,
        ], 200);
    }

    public function showServicesArchive(){
        $services = Services::where('serv_status', '=', 'Archive')->get();

        return response()->json([
            'status' => 'success',
            'data' => $services,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function restoreArchiveStaff(Request $request, $id)
    {
        $staff = User::findOrFail($id);
        $request['status'] = 'verified';

        $staff->update($request->all());


        return response()->json([
            'status' => 'success',
            'data' => $staff,
        ], 200);

    }
    public function restoreArchiveRefer(Request $request, $id)
    {
        $refer = Appointment::findOrFail($id);
        $request['appnt_status'] = 'Pending';

        $refer->update($request->all());


        return response()->json([
            'status' => 'success',
            'data' => $refer,
        ], 200);

    }

    public function restoreArchiveServices(Request $request, $id)
    {
        $service = Services::findOrFail($id);
        $request['serv_status'] = 'Verified';

        $service->update($request->all());


        return response()->json([
            'status' => 'success',
            'data' => $service,
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
