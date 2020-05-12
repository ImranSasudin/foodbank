<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
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
            'phone' => 'required|numeric',
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
           return redirect()->route('employees.list')->with('register','true');
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

        // return view('employees.view', ['employee' => $employee])->with('success', 'true');
        return redirect()->route('employees.viewProfile')->with('success','true');
    }

    public function list(){

        $employee = Employee::where('id', '!=', Auth::guard('employee')->user()->id)->paginate(6);
        return view('employees.list', ['employees' => $employee, 'employeeActive' => true]);
    }

    public function registration()
    {
        return view('employees.registration' , ['employeeActive' => true]);
    }

    public function editEmployee($id)
    {
        //Find the employee
        $employee = Employee::find($id);
        return view('employees.updateEmployee', ['employee' => $employee, 'employeeActive' => true]);
    }

    public function updateEmployee(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'role' => 'required',
            'email' => 'required|email|unique:employees,email,'. $request->id,
            'phone' => 'required|numeric',
        ]);

        $password = Hash::make($request->password);

        $Employee = Employee::find($request->id);
        $Employee->name = $request->name;
        $Employee->email = $request->email;
        $Employee->password = $password; //hashed password.
        $Employee->role = $request->role;
        $Employee->phone = $request->phone;
        $Employee->save();

        if ($Employee->save()) {
            // session()->flash('update', 'true');
            return redirect()->route('employees.list')->with('update','true');
        }

    }
}
