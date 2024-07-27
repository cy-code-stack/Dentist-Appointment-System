<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$role)
    {
        // if (Auth::check()) {
            
        //     $user = Auth::user();
            
        //     // Check if the user has any of the specified roles
        //     if (in_array($user->role, $roles)) {
        //         switch ($user->role) {
        //             case 'Dentist':
        //                 return redirect(route('admin'));
        //             case 'Assistant':
        //                 return redirect(route('staff'));
        //             case 'Patient':
        //                 return redirect(route('appointment'));
        //             default:
        //                 break;
        //         }
        //     }
        // }

        // if (!$request->user() || $request->user()->role != $roles) {
        //     return back();
        // }

        $id = $request->user()->id;
        if (!User::where([['id', $id],['role',$role]])->exists()) {
            // Redirect...
            return back();
        }
        
        // Redirect unauthenticated or unauthorized users to the login page
        // return abort(403, "Page Not Found");
        return $next($request);
    }
}
