<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    // Hardcoded credentials
    private const USERNAME = 'admin';
    private const PASSWORD = 'admin123';
    
    /**
     * Show the login form
     */
    public function showLogin()
    {
        // If already logged in, redirect to dashboard
        if (session('logged_in')) {
            return redirect()->route('dashboard');
        }
        
        return view('auth.login');
    }
    
    /**
     * Handle login attempt
     */
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        
        $username = $request->input('username');
        $password = $request->input('password');
        
        // Check credentials
        if ($username === self::USERNAME && $password === self::PASSWORD) {
            // Set session
            session([
                'logged_in' => true,
                'username' => self::USERNAME
            ]);
            
            return redirect()->route('dashboard');
        }
        
        // Failed login
        return back()->with('error', 'Username atau password salah!')->withInput();
    }
    
    /**
     * Handle logout
     */
    public function logout()
    {
        session()->flush();
        return redirect()->route('login');
    }
}
