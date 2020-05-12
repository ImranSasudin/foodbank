<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;

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

    public function logout() {
        Session::flush();
        Auth::logout();
        return Redirect()->route('users.loginForm');
    }

    public function list(){

        $user = User::paginate(6);
        return view('donors.list', ['users' => $user, 'donorActive' => true]);
    }

    public function registration()
    {
        return view('donors.registration' , ['donorActive' => true]);
    }

    public function postRegistration(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'password' => 'required',
            'registerNum' => 'required',
            'email' => 'required|unique:users|email',
            'phone' => 'required|numeric',
        ]);

        $password = Hash::make($request->password);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $password; //hashed password.
        $user->registerNum = $request->registerNum;
        $user->phone = $request->phone;
        $user->save();

        if ($user->save()) {
           return redirect()->route('users.list')->with('register','true');
        }

    }

    public function edit($id){

        $user = User::find($id);
        return view('donors.update', ['user' => $user, 'donorActive' => true]);
    }

    public function update(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'registerNum' => 'required',
            'email' => 'required|email|unique:users,email,'.$request->id ,
            'phone' => 'required|numeric',
        ]);

        $password = Hash::make($request->password);

        $user = User::find($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $password; //hashed password.
        $user->registerNum = $request->registerNum;
        $user->phone = $request->phone;
        $user->save();

        if ($user->save()) {
           return redirect()->route('users.list')->with('update','true');
        }

    }
}
