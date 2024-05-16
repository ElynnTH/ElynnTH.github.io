<?php

namespace App\Http\Controllers;

use App\Mail\NewUserEmail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function register(){
        return view('auth.register');
    }

    public function store(){

        $validated = request()->validate([
            'name' => 'required|min:3|max:40',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        Mail::to($user -> email)
        ->send(new NewUserEmail($user));

        return redirect()->route('dashboard')->with('success','Account created Successfully');
    }

    public function login(){
        return view('auth.login');
    }

    public function authenticate(){

        
        $validated = request()->validate([
            'email' => 'required|email',
            'password' => 'required|',
        ]);

        if(auth()->attempt($validated)){
            request()->session()->regenerate();
            return redirect()->route('dashboard')->with('success','Logged in Successfully');
        }

        return redirect()->route('login')->with([
            'email' => "Information not matching our record!"
        ]);
    }

    public function logout(){
        auth()->logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('dashboard')->with('success','Logged out Successfully');
    }
}
