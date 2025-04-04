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
    public function __construct(){
        $this->middleware('auth');
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
    public function showArchieve(Request $request)
    {
        $limit = $request->input('limit', 5);
        $page = $request->input('page', 1);

        $query = User::whereNotIn("role", ['Dentist', 'Assistant'])
                        ->where('status', '<>', 'verified');

        $records = $query->paginate($limit, ['*'], 'page', $page);
        return response()->json([
            'status' => 'success',
            'data' => $records->items(),
            'meta' => [
                'current_page' => $records->currentPage(),
                'last_page' => $records->lastPage(),
                'total' => $records->total(),
            ],
        ], 200);
    }

    public function showAppointmentDeclined(Request $request){
        $limit = $request->input('limit', 5);
        $page = $request->input('page', 1);

        $query = Appointment::where('appnt_status', '=', 'Declined')
                                ->with('patient', 'appointServices');

        $records = $query->paginate($limit, ['*'], 'page', $page);

        return response()->json([
            'status' => 'success',
            'data' => $records->items(),
            'meta' => [
                'current_page' => $records->currentPage(),
                'last_page' => $records->lastPage(),
                'total' => $records->total(),
            ],
        ], 200);
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

}
