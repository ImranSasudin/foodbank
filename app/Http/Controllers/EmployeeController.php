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

    public function dashboard()
    {
        return view('employees.dashboard', ['dashboard' => true]);
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

        if ($Employee->save()) {
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
        if (Auth::guard('employee')->attempt(['id' => $request->id, 'password' => $request->password])) {
            $message = "Login Successfull";
            return view('employees.dashboard', ['message' => $message, 'dashboard' => true]);
            // alert()->warning('WarningAlert','Lorem ipsum dolor sit amet.');
        } else {
            $message = "Invalid Login";
            return view('login', ['message' => $message]);
        }
        // return Redirect::to("users.login")->withSuccess('Oppes! You have entered invalid credentials');
    }

    public function view()
    {

        //Find the employee
        $employee = Employee::find(Auth::guard('employee')->user()->id);
        return view('employees.view', ['employee' => $employee]);
    }

    public function editProfile()
    {
        //Find the employee
        $employee = Employee::find(Auth::guard('employee')->user()->id);
        return view('employees.updateProfile', ['employee' => $employee]);
    }

    public function updateProfile(Request $request)
    {

        request()->validate([
            'name' => 'required',
            'email' => 'required | unique:employees,email,'. Auth::guard('employee')->user()->id,
            'phone' => 'required | numeric',
        ]);

        //Find the employee
        $employee = Employee::find(Auth::guard('employee')->user()->id);
        $employee->name = $request->input('name');
        $employee->email = $request->input('email');
        $employee->phone = $request->input('phone');
        $employee->save(); //persist the data

        return view('employees.view', ['employee' => $employee, 'success' => true] );

    }
}
