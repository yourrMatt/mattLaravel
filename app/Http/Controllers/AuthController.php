<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegister(){
        return view("/signup");
    }
    public function showLogin(){
        return view("/login");
    }

    public function register(Request $request){
        if(User::where("email", $request->email)->exists()){
            return back()->with("error","Email already exist!");
        }

        if($request->confirm_password !== $request->password){       
            return back()->with("error","Password do not match!");
        }

        User::create([
            "fullname"=> $request->fullname,
            "email"=> $request->email,
            "password"=> Hash::make($request->password)
        ]);

        return redirect("/login")->with("success","Registered Successfully!");
    }

    public function login(Request $request){    
        $user = User::where("email", $request->email)->first();

        if(!$user){
            return back()->with("error","Account not existing!");
        }

        if(!Hash::check($request->password, $user->password) ){
            return back()->with("error","Password is incorrect!");
        }

        session(["user"=> $user]);
        return redirect("dashboard")->with("success","Login Successfully!");
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
