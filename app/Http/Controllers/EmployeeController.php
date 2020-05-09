<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function registration()
    {
        return view('employees.registration');
    }

    public function postRegistration(Request $request)
    {
        request()->validate([
        'name' => 'required',
        'password' => 'required',
        'role' => 'required',
        'email' => 'required|unique:employees|email',
        'phone' => 'required',
        ]);

        $password = Hash::make($request->password);

        $Employee = new Employee;
        $Employee->name = $request->name;
        $Employee->email = $request->email;
        $Employee->password = $password; //hashed password.
        $Employee->role = $request->role;
        $Employee->phone = $request->phone;
        $Employee->save();

        if($Employee->save()) {
            echo "SUCCESS";
            // \Alert::success('Employee succesfully registered!')->flash();
        }

        // return Redirect::route("employees.index")->withSuccess('Great! You have Successfully loggedin');
    }

    public function postLogin(Request $request)
    {
        request()->validate([
        'id' => 'required',
        'password' => 'required',
        ]);

        $credentials = $request->only('id', 'password');
        if (Auth::guard('employee')->attempt(['id' => $request->id , 'password' => $request->password ])) {
            // return redirect()->route('employees.index');
            echo "SUCCESS LOGIN EMPLOYEE";
        }
        else{
            echo "INVALID LOGIN EMPLOYEE";
        }
        // return Redirect::to("users.login")->withSuccess('Oppes! You have entered invalid credentials');
    }
}
