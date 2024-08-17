<?php

namespace App\Http\Controllers\Staff\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AssistantProfileController extends Controller
{
    public function __construct(){
        $this->middleware("auth");
    }

    public function uploadImage(Request $request){
        $request->validate([
            'profile_img' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if($request->hasFile('profile_img')){
            $userAvatar = Auth::user();
            $imgAvatarName = time() . '.' . $request->file('profile_img')->extension();
            $request->file('profile_img')->move(public_path('profile'), $imgAvatarName);
            $userAvatar->profile_img = '/profile/' . $imgAvatarName;
            $userAvatar->save();
        }

        return response()->json([
            'message' => 'Profile updated successfully.',
            'data' => $userAvatar,
        ], 200);
    }

    public function removeAvatar(){
        $userID = Auth::user();
        $avatarPath = public_path($userID->profile_img);

        if(file_exists($avatarPath)){
            unlink($avatarPath);
        }

        $userID->profile_img = null;
        $userID->save();

        return response()->json([
            'message' => 'Profile deleted successfully.',
            'data' => $userID,
        ], 200);
    }

    public function displayProfile(){
        $profileUser = User::where('id',  Auth::user()->id)
                        ->where('status', '=', 'verified')
                        ->where('is_verified', '<>', 0)
                        ->first();
        
        return response()->json([
            'message' => 'User Profile display successfully.',
            'data' => $profileUser
        ], 200);
    }

    public function updateAssistantProfile(Request $request, $id){
        $user = User::find($id);
        $user->update($request->all());

        return response()->json([
            'message' => 'User Profile updated successfully.',
            'data' => $user
        ], 200);
    }

    public function changePassword(){
        $user = Auth::user();

        request()->validate([
            'old_password' => 'required|string|current_password',
            'password' => 'required|string|confirmed',
        ], [
            'old_password.current_password' => 'The old password you entered does not match our records',
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
        ], 200);
    }

    public function destroyUserCred(){
        $user = Auth::user();
        $user->delete();

        return response()->json([
            'message' => 'User deleted successfully.',
            'data' => $user
        ], 200);
    }

}
