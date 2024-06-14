<?php

namespace App\Http\Controllers\Auth;

use App\Models\VerifyToken;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Mail\welcomeMail;



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
    public function submitUser(Request $request)
{
    $request->validate([
        'firstname' => 'required',
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
        'phone_number.digits_between' => 'Phone number must be between 1 and 11 digits long.',
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
            $user->session_id = Session::getId(); 
            $user->save();
        

            if ($user->is_verified == 0) {
                // Resend OTP
                $validToken = rand(100000, 999999);
                $get_token = new VerifyToken();
                $get_token->token = $validToken;
                $get_token->email = $user->email;
                $get_token->save();
            
                Mail::to($user->email)->send(new welcomeMail($user->email, $validToken, $user->firstname, $user->lastname ));
                Alert::error('Login Failed', 'Your account is not verified. Please enter the otp send to your email.')->persistent(true);
                return redirect(route('verify'));
            }elseif ($user->status == 'unverified') {
                Alert::error('Login Failed', 'Your account is not verified.')->persistent(true);
                return redirect()->back()->withErrors(['email' => 'Your account is not verified.']);
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

    public function forgotPass(){

    }

    public function logout(Request $request)
    {
        if (session_id() != Auth::user()->session_id) {
            Auth::logout();
            Alert::success('Logout Successfully', 'You have successfully logout.')->persistent(1);
            return redirect(route('signin'));
        }
    }

}
