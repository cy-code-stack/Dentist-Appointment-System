<?php

namespace App\Http\Controllers\Auth;

use App\Mail\ForgotPasswordMail;
use App\Models\ForgotPassModel;
use App\Models\VerifyToken;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Mail\welcomeMail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;



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

    public function indexVerify(){
        return view("auth.verify");
    }

    public function indexForgot()
    {
        return view("auth.forgot");
    }

    public function resetPass($token){
        return view("auth.reset", ['token' => $token]);
    }


    public function submitUser(Request $request){

    $request->validate([
        'firstname' => 'required',
        'middle_name' => 'nullable',
        'lastname' => 'required',
        'home_address' => 'required',
        'phone_number' => ['required', 'numeric', 'digits_between:1,11'],
        'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')],
        'age' => ['required', 'numeric'],
        'sex' => 'required',
        'marital_status' => 'required',
        'occupation' => 'required',
        'password' => [
            'required',
            'min:8',
            'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/',
            'confirmed'
        ],
    ], [
        'firstname.required' => 'Please enter your firstname.',
        'lastname.required' => 'Please enter your lastname.',
        'home_address.required' => 'Please enter your home address.',
        'phone_number.required' => 'Please enter your Phone Number.',
        'phone_number.numeric' => 'Phone number must contain only numbers.',
        'phone_number.digits_between' => 'Phone number must be 11 digits long.',
        'email.required' => 'Please enter your email address.',
        'email.email' => 'Please enter a valid email address.',
        'email.max' => 'Email address must not exceed 255 characters.',
        'email.unique' => 'This email address is already taken.',
        'occupation.required' => 'Please enter your occupation.',
        'marital_status.required' => 'Please enter your marital status.',
        'sex.required' => 'Please enter your gender.',
        'age.required' => 'Please enter your age.',
        'age.numeric' => 'Phone number must contain only numbers.',
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
        $validToken = rand(100000, 999999);

        $get_token = new VerifyToken();
        $get_token->token = $validToken;
        $get_token->email = $data['email'];
        $get_token->save();
        $get_user_email = $data['email'];
        $get_user_firstname = $data['firstname'];
        $get_user_lastname = $data['lastname'];

        Mail::to($data['email'])->send(new welcomeMail($get_user_email, $validToken, $get_user_firstname, $get_user_lastname ));
        return redirect(route('verify'))->with('success', 'Account Registered Done');
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
            $user->save();
        
            // random string 
            if ($user->is_verified == 0 || $user->status == 'unverified') {
                $validToken = rand(100000, 999999);
                $get_token = new VerifyToken();
                $get_token->token = $validToken;
                $get_token->email = $user->email;
                $get_token->save();
            
                Mail::to($user->email)->send(new welcomeMail($user->email, $validToken, $user->firstname, $user->lastname ));
                Alert::error('Login Failed', 'Your account is not verified. Please enter the otp send to your email.')->persistent(true);
                return redirect(route('verify'));
            }
            switch ($user->role) {
                case 'Dentist':
                    Alert::success('Login Successful', 'Welcome back Admin ' . $user->firstname)->persistent(true);
                    return redirect(route('admin'));
                case 'Assistant':
                    return redirect(route('staff'));
                case 'Patient':
                    return redirect(route('appointment'));
                default:
                    break;
            }
        } else {
            Alert::error('Login Failed', 'Invalid email or password.')->persistent(true);
            return redirect()->back()->withErrors(['email' => 'Invalid email or password.']);
        }
    }

    public function indexForgotAcc(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter valid email address.',
            'email.exists' => 'Invalid Email. Make sure your email is already registered in the system',
        ]);

        $token =  Str::random(64);

        $passData = new ForgotPassModel();
        $passData->email = $request->email;
        $passData->token = $token;
        $passData->created_at = Carbon::now();
        $passData->updated_at = Carbon::now();
        $passData->save();

        Mail::to($request->email)->send(new ForgotPasswordMail($request->email, $token));

        try {
            Mail::to($request->email)->send(new ForgotPasswordMail($request->email, $token));
            Alert::success('Email Sent', 'You may now check your email address to reset your password')->persistent(true);
        } catch (\Exception $e) {
            Alert::error('Email Failed', 'There was an error sending the email. Please try again later.')->persistent(true);
        }

        return redirect()->back();
    }

    public function changePass(Request $request){
        $request->validate([
            'password' => [ 'required', 'min:8', 'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/', 'confirmed'],
        ], [
            'password.required' => 'Please enter your password.',
            'password.min' => 'Password must be at least 8 characters long.',
            'password.regex' => 'Password must contain at least one letter, one number, one special character, and one uppercase letter.',
            'password.confirmed' => 'The password confirmation does not match.'
        ]);
    
    
        $dataToken = ForgotPassModel::where('token', $request->token)->first();
    
        if (!$dataToken) {
            return redirect()->back()->withErrors(['token' => 'Invalid or expired token.']);
        }
    
        $user = User::where('email', $request->email)->first();
    
        if (!$user) {
            return redirect()->back()->withErrors(['email' => 'User not found.']);
        }
    
        $user->password = Hash::make($request->password);
        $user->save();
    
        $dataToken->delete();
    
        Alert::success('Password Change', 'You may now login to your account')->persistent(true);
        return redirect(route('signin'))->with('success', 'Your password has been changed.');
    }
    

    public function otpVerify(Request $request){

        $request->validate([
            'token' => 'required|string|digits:6'  
        ],[
            'token.digits' => 'It must minimum of 6 digits',
        ]);

        $get_token = $request->token;
        $token_record = VerifyToken::where('token', $get_token)->first();

        if ($token_record) {
            $token_record->is_activated = 1;
            $token_record->save();

            $user = User::where('email', $token_record->email)->first();
            $user->is_verified = 1;
            $user->status = 'verified';
            $user->save();

            $token_record->delete();

            Alert::success('Account Verified', 'You may now login your account')->persistent(true);
            return redirect(route('signin'))->with('success', 'Your Account is Activated');
        }else{
            return redirect()->back()->with('incorrect', 'Your OTP is Invalid. Please check your email once.');
        }
    }

    public function logout(Request $request)
    {
            Auth::logout();
            return redirect(route('signin'));
    }
}
