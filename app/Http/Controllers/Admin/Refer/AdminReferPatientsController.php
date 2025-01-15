<?php

namespace App\Http\Controllers\Admin\Refer;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AdminReferPatientsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function getVerifiedPatients(Request $request){
        $limit = $request->input('limit', 10);
        $page = $request->input('page', 1);
        $search = $request->input('search', '');
        $query = Appointment::whereNotIn('appnt_status', ['Archive', 'Approved', 'Pending Approval', 'Declined', 'Completed'])
                                ->with('appointServices', 'patient');
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->whereHas('patient', function ($subQuery) use ($search) {
                    $subQuery->where('firstname', 'LIKE', "%{$search}%")
                                ->orWhere('lastname', 'LIKE', "%{$search}%");
                })
                ->orWhere('appnt_status', 'LIKE', "%{$search}%");
            });
        }

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
