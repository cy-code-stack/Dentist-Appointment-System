<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (Auth::check()) {
            
            $user = Auth::user();
            
            // Check if the user has any of the specified roles
            if (in_array($user->role, $roles)) {
                switch ($user->role) {
                    case 'admin':
                        return redirect(route('admin'));
                    case 'staff':
                        return redirect(route('staff'));
                    case 'patient':
                        return redirect(route('appointment'));
                    default:
                        break;
                }
            }
        }
        
        // Redirect unauthenticated or unauthorized users to the login page
        return redirect(route('signin'))->withErrors(['error' => 'Unauthorized.']);
    }
}
