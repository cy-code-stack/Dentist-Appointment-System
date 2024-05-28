<?php

namespace App\Http\Controllers\Admin\Manage_Services;

use App\Http\Controllers\Controller;
use App\Models\Services;
use Illuminate\Http\Request;

class ManageServicesController extends Controller
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
    public function storeService(Request $request)
    {
        $services = $request->all();
        $response = Services::create($services);
        return response()->json([
            'status' => 'success',
            'data' => $response,
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function showServices()
    {
        return Services::all();
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateServices(Request $request, $id)
    {
        $services = Services::findOrFail($id);
        $services->update($request->all());
        return response()->json([
            'status' => 'success',
            'data' => $services,
        ], 200); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyServices($id)
    {
        $services = Services::findOrFail($id);
        $services->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Services deleted successfully',
        ], 200);
    }
}
