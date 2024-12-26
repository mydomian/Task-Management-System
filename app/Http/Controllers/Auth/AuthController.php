<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request){
        if($request->isMethod('post')){
            $validated = $request->validate([
                'email' => 'required|string|email',
                'password' => 'required|string|min:4',
            ]);
            if (Auth::attempt($validated)) {
                return redirect()->route('tasks.index')->with('success', 'Logged in successfully.');
            }
            return back()->with('error','Invalid Credentials! Please try again');
        }
        return Auth::check() ? redirect()->route('tasks.index') : view('auth.login');
    }
    public function register(Request $request){
        if($request->isMethod('post')){
            $validated = $this->validation($request);
            $user = User::create($validated);
            if ($user && Auth::attempt($validated)) {
                return redirect()->route('tasks.index')->with('success', 'Registration Successfully');
            }
            return back()->with('error','Something is wrong! Please try again');
        }
        return view('auth.register');
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('login')->with('success','Logout Successfully');
    }
    // for api authentication using sanctum
    public function user_login_api(Request $request){
        $user = User::whereEmail($request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Login Faild! Try Again With Valid Credentials',
            ], 401);
        }
        return response()->json([
            'message' => 'Login Successfully',
            'token' => $this->createToken($user),
            'user' => $user,
        ], 200);
    }
    public function user_register_api(Request $request){
        $validated = $this->validation($request);
        $user = User::create($validated);
        if($user){
             return response()->json([
                'message' => 'Registraion Successfully',
                'token' => $this->createToken($user),
                'user' => $user,
            ], 200);
        }
        return response()->json(['message' => 'Registraion Faild! Try Again',],422);
    }
    public function user_logout(Request $request){
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out successfully'], 200);
    }
    public function createToken($user){
        return $token = $user->createToken('api_token')->plainTextToken;
    }
    public function validation($request){
        return $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:4|confirmed',
        ]);
    }
}
