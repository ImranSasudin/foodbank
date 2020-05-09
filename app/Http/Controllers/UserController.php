<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function postLogin(Request $request)
    {
        request()->validate([
        'email' => 'required|email',
        'password' => 'required',
        ]);

        if (Auth::guard('user')->attempt(['email' => $request->email , 'password' => $request->password ])) {
            // return redirect()->route('employees.index');
            echo "SUCCESS LOGIN DONOR";
        }
        else{
            echo "INVALID LOGIN DONOR";
        }
        // return Redirect::to("users.login")->withSuccess('Oppes! You have entered invalid credentials');
    }
}
