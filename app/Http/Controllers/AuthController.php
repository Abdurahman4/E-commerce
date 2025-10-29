<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // عرض صفحة التسجيل
    public function showRegister()
    {
        return view('auth.register');
    }

    // معالجة التسجيل
    public function register(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6|confirmed',
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    // مافي تسجيل دخول هون
    return redirect()->route('login')->with('success', 'Your register has been completed 🎉، please login  ');
}

    
    // عرض صفحة تسجيل الدخول
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        if (auth()->attempt($credentials)) {
            $request->session()->regenerate();
    
            if (auth()->user()->role === 'admin') {
                return redirect()->route('admin.products.index');
            }
            else {
                // لو يوزر عادي
                return redirect()->route('shop'); 
            }
    
        }
    
    return back()->with('error', 'Invalid email or password!');
    }
    

    // Log out 
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
