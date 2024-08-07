<?php

namespace App\Http\Controllers;

use App\Models\Inquiries;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class LandingPageController extends Controller
{
    public function makeInquiry(Request $request)
    {
        // Validate the request
        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|email',
            'fblink' => 'required',
            'cnumber' => ['required', 'numeric', 'digits_between:1,11'],
            'message' => 'required',
        ], [
            'fname.required' => 'Please enter your firstname.',
            'lname.required' => 'Please enter your lastname.',
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'fblink.required' => 'Please enter your fb link.',
            'cnumber.required' => 'Please enter your Phone Number.',
            'cnumber.numeric' => 'Phone number must contain only numbers.',
            'cnumber.digits_between' => 'Phone number must be between 1 and 11 digits long.',
            'message.required' => 'This field is required.',
        ]);

        try {
            Inquiries::create([
                'fname' => $request->input('fname'),
                'lname' => $request->input('lname'),
                'email' => $request->input('email'),
                'fblink' => $request->input('fblink'),
                'cnumber' => $request->input('cnumber'),
                'message' => $request->input('message'),
            ]);

            Alert::success('Inquiry Sent')->persistent(true);
        } catch (\Exception $e) {
            Alert::error('Inquiry Failed', 'Something went wrong!')->persistent(true);
        }

        return redirect('/');
    }


}
