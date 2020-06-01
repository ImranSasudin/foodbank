<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Food;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;

class UserController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function dashboard()
    {
        return view('donors.dashboard', ['dashboard' => true]);
    }

    public function postLogin(Request $request)
    {
        request()->validate([
        'email' => 'required|email',
        'password' => 'required',
        ]);

        if (Auth::guard('user')->attempt(['email' => $request->email , 'password' => $request->password ])) {
            // $message = "Login Successfull";
            // return redirect()->route('users.dashboard')->with('message', $message);
            return redirect()->route('users.dashboard')->with('login','true');
        }
        else{
            $message = "Invalid Login";
            return view('login', ['message' => $message]);
            
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

    public function view()
    {
        //Find the donor
        $user = User::find(Auth::guard('user')->user()->id);
        return view('donors.view', ['user' => $user]);
    }

    public function password(Request $request){

        request()->validate([
            'curPass' => 'required',
            'newPass' => 'required',
            'reNewPass' => 'required',
        ]);

        $user = User::find(Auth::guard('user')->user()->id);
        $realPassword = $user->password;

        $currentPassword = $request->curPass;
        $newPassword = $request->newPass;
        $reenterNewPassword = $request->reNewPass;

        // Hash::check($currentPassword, $realPassword);

        if(!Hash::check($currentPassword, $realPassword)){
            return redirect()->route('users.viewProfile')->with('error','Incorrect current password');
        }
        else if($newPassword != $reenterNewPassword){
            return redirect()->route('users.viewProfile')->with('error','New password not matching. Please re-enter properly');
        }
        else{
            $user->password = Hash::make($newPassword);
            $user->save();
            return redirect()->route('users.viewProfile')->with('password','true');
        }
    }

}
