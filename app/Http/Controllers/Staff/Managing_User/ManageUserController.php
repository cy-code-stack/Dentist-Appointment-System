<?php

namespace App\Http\Controllers\Staff\Managing_User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\UserEmailVerification;
use App\Mail\UserAddedVerification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class ManageUserController extends Controller
{


    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function storeUser(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'home_address' => 'required',
            'phone_number' => ['required', 'numeric', 'digits_between:1,11'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')],
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
        ]);
    
        // Store the plain password temporarily
        $plainPassword = $request->password;
    
        // Prepare the data for user creation
        $data = $request->all();
        $data['password'] = Hash::make($plainPassword);
        $data['status'] = 'verified';
        $data['is_verified'] = 1;
    
        // Create the user and handle any potential errors
        try {
            $response = User::create($data);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'User creation failed.',
                'error' => $e->getMessage(),
            ], 500);
        }
    
        // Prepare the mail data
        $addMailData = [
            'main-title' => 'Account Verified',
            'title' => 'Your account has been successfully verified, and you can now log in. 
                        Please visit our website and enter your email and password, and click "Sign In."
                        After login, we recommend changing your password as soon as possible.
                        If you have any questions or encounter any issues, please contact at Oconrenegrace@gmail.com or 092 9603 3673. 
                        Thank you for choosing Graces Dental Clinic.',
            'name' => $response->firstname . ' ' . $response->lastname,
            'email' => $response->email,
            'password' => $plainPassword,
            'time' => $response->created_at,
            'status' => $response->status,
            'link' => 'http://127.0.0.1:8000/user/signin',
        ];
    
        // Send the verification email
        Mail::to($response->email)->send(new UserAddedVerification($addMailData));
    
        // Return the response
        return response()->json([
            'status' => 'success',
            'data' => $response,
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function showUser(Request $request)
    { 
        $limit = $request->input('limit', 10);
        $page = $request->input('page', 1);
        $search = $request->input('search', '');

        $query = User::whereNotIn("role", ['Dentist', 'Assistant'])
                        ->whereNotIn('status', ['archive', 'banned'])->orderBy('created_at', 'desc');

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('firstname', 'LIKE', "%{$search}%")
                  ->orWhere('lastname', 'LIKE', "%{$search}%");
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

    /**
     * Update the specified resource in storage.
     */

    public function verifyUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request['status'] = 'verified';
        $user->update($request->all());

        // Prepare email data
        $mailData = [
            'main-title' => 'Account Verified',
            'title' => 'Your account has been successfully verified, and you can now log in. 
                        Please visit Website URL and enter your email and password, and click "Sign In." 
                        If you have any questions or encounter any issues, please contact at Oconrenegrace@gmail.com or 092 9603 3673. 
                        Thank you for choosing Graces Dental Clinic.',
            'name' => $user->firstname . ' ' . $user->lastname,
            'email' => $user->email,
            'time' => $user->created_at,
            'status' => $user->status,
            'link' => 'http://127.0.0.1:8000/user/signin',
        ];

        // Send email using Mail facade
        $result = Mail::to($user->email)->send(new UserEmailVerification($mailData));

        // Check if email was sent successfully
        if ($result) {
            return response()->json([
                'status' => 'success',
                'message' => 'User verified and email sent successfully',
                'data' => $user,
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to send email',
            ], 500);
        }
    }


    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());
        return response()->json([
            'status' => 'success',
            'data' => $user,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function archieveUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request['status']= 'banned';
        $user->update($request->all());
        return response()->json([
            'status' => 'success',
            'message' => 'User banned successfully',
        ], 200);
    }
}
