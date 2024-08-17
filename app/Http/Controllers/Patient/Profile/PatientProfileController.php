<?php

namespace App\Http\Controllers\Patient\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PatientProfileController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function displayInfo(){
        $user = User::where('id', Auth::user()->id)
                    ->where('is_verified', '<>', 0)
                    ->where('status', '=', 'verified')
                    ->first(); 
                    
        return response()->json($user); 
    }

    public function uploadImage(Request $request){
        $request->validate([
            'profile_img'=> 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if($request->hasFile('profile_img')){
            $user = Auth::user();
            $imgName = time() . '.' . $request->file('profile_img')->extension();
            $request->file('profile_img')->move(public_path('profile'), $imgName);
            $user->profile_img = '/profile/' . $imgName;
            $user->save();
        }

        return response()->json([
            'message' => 'Profile updated successfully.',
            'data' => $user,
        ], 200);
    }

    public function updatePatientProfile(Request $request, $id){
        $userProfile = User::findOrFail($id);
        $userProfile->update($request->all());

        return response()->json([
            'message' => 'User Profile updated successfully.',
            'data' => $userProfile
        ], 200);
    }

    public function removePatientImg(){
        $user = Auth::user();
        $img_path = public_path($user->profile_img); 

        if (file_exists($img_path)) {
           unlink($img_path);
        }
        $user->profile_img = null;
        $user->save();

        return response()->json([
            'message' => 'Image delete successfully.',
            'data' => $user
        ], 200);
    }

    public function updatePatientPassword() {

        $user = Auth::user();

        request()->validate([
            'old_password' => 'required|string|current_password',
            'password' => 'required|string|confirmed',
        ], [
            'old_password.current_password' => 'The old password does not match.',
            'old_password.required' => 'The current password is required.',
            'old_password.string' => 'The current password must be a valid string.',
            'password.required' => 'The new password is required.',
            'password.string' => 'The new password must be a valid string.',
            'password.confirmed' => 'The new password confirmation does not match.',
        ]);
  
    
        $user->password = Hash::make(request()->password);
        $user->save();
    
        return response()->json([
            'message' => 'Password updated successfully.',
            'data' => $user
        ]);
    }

    public function destroyPatientUser() {
        $user = Auth::user();
        $user->delete();
        return response()->json([
            'message' => 'User deleted successfully.',
            'data' => $user
        ]);
    }

    
}
