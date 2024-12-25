<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Container\Attributes\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request){
dd('login');
        // if($request->isMethod('post')){
        //     if (Auth::attempt($request->only('email', 'password'))) {
        //         return redirect()->route('tasks.index')->with('success', 'Logged in successfully.');
        //     }
        //     return back()->with('error','Invalid Credentials! Please try again');
        // }
        return view('auth.login');
    }
    public function register(RegisterRequest $request){
        return 'ok';
        if($request->isMethod('post')){
            $user = User::create($request->validated());
            if (Auth::attempt($user)) {
                return redirect()->route('tasks.index')->with('success', 'Registration Successfully');
            }
            return back()->with('error','Something is wrong! Please try again');
        }
        return view('auth.register');
    }

}
