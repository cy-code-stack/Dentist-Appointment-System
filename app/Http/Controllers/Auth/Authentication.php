<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Authentication extends Controller
{
    public function index(){
        return view("auth.signin");
    }

    public function indexSignup(){
        return view("auth.signup");
    }

    public function indexForgot(){
        return view("auth.forgot");
    }
}
