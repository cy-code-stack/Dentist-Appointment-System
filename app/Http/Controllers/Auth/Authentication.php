<?php

namespace App\Http\Controllers\Auth;

use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;



class Authentication extends Controller
{
    public function index()
    {
        return view("auth.signin");
    }

    public function indexSignup()
    {
        return view("auth.signup");
    }

    public function indexForgot()
    {
        return view("auth.forgot");
    }



    public function submitUser(Request $request)
    {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'home_address' => 'required',
            'phone_number' => ['required', 'numeric', 'digits_between:1,11'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')],
            'password' => [
                'required',
                'min:8',
                'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/',
                'confirmed' // This rule ensures that password_confirmation field matches the password field
            ],
        ], [
            'firstname.required' => 'Please enter your firstname.',
            'lastname.required' => 'Please enter your lastname.',
            'home_address.required' => 'Please enter your home address.',
            'phone_number.required' => 'Please enter your Phone Number.',
            'phone_number.numeric' => 'Phone number must contain only numbers.',
            'phone_number.digits_between' => 'Phone number must be between 1 and 11 digits long.',
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'email.max' => 'Email address must not exceed 255 characters.',
            'email.unique' => 'This email address is already taken.',
            'password.required' => 'Please enter your password.',
            'password.min' => 'Password must be at least 8 characters long.',
            'password.regex' => 'Password must contain at least one letter, one number, one special character, and one uppercase letter.',
            'password.confirmed' => 'The password does not match.'
        ]);

        $user = User::where('email', $request->email)->first();
        if ($user) {
            Alert::error('Error', 'This email address is already registered.')->persistent(true);
            return redirect()->back()->withErrors(['email' => 'This email address is already registered.']);
        }

        $request['password'] = bcrypt($request['password']);
        $data = $request->all();
        $response = User::create($data);

        if ($response) {
            Alert::success('Registered Successfully', 'Verification will be sent directly to your registered email. Just wait for it.')->persistent(true);
            return redirect(route('signin'))->with('success', 'Registered Successfully');
        } else {
            Alert::error('Error', 'Registration Failed')->persistent(true);
            return redirect(route('signup'))->with('error', 'Registration Failed');
        }
    }

    public function loginUsers(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ], [
            'email.required' => 'Please enter your email address.',
            'password.required' => 'Please enter your password.',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            switch ($user->role) {
                case 'admin':
                    Alert::success('Login Successful', 'Welcome back! Admin')->persistent(true);
                    return redirect(route('admin'));
                case 'staff':
                    return redirect(route('staff'));
                case 'patient':
                    return redirect(route('appointment'));
                default:
                    break;
            }
        } else {
            Alert::error('Login Failed', 'Invalid email or password.')->persistent(true);
            return redirect()->back()->withErrors(['email' => 'Invalid email or password.']);
        }
    }

    public function logout(Request $request)
    {
        Session::flush();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        Alert::success('Logged Out', 'You have been successfully logged out.')->persistent(true);
        return redirect(route('signin'));
    }

}
