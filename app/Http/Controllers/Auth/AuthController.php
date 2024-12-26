<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Container\Attributes\Auth;

class AuthController extends Controller
{
    public function login(Request $request){
        if($request->isMethod('post')){
            $credentials = $request->validate([
                'email' => 'required|string|email',
                'password' => 'required|string|min:4',
            ]);
            if (Auth::attempt($credentials)) {
                return redirect()->route('tasks.index')->with('success', 'Logged in successfully.');
            }
            return back()->with('error','Invalid Credentials! Please try again');
        }
        return view('auth.login');
    }
    public function register(Request $request){
        if($request->isMethod('post')){
            $credentials = $request->validate([
                'name' => 'required|string',
                'email' => 'required|string|email|unique:users,email',
                'password' => 'required|string|min:4|confirmed',
            ]);
            $user = User::create($credentials);
            if (Auth::attempt($user)) {
                return redirect()->route('tasks.index')->with('success', 'Registration Successfully');
            }
            return back()->with('error','Something is wrong! Please try again');
        }
        return view('auth.register');
    }

}
