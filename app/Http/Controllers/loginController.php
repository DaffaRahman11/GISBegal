<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class loginController extends Controller
{
    public function index(){
        return view('Admin.login');
    }

    public function authenticate(Request $request){
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        try{
            if(Auth::attempt($credentials)){
                $request->session()->regenerate();
                return redirect()->intended('/dashboard');
            }
            return back()->with('loginError', 'Email atau password salah.');
            
        }catch (\Exception $e){
            return redirect('/login')->with('loginError', 'Terjadi kesalahan sistem: ' . $e->getMessage());
        }

    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        
        $request->session()->regenerateToken();

        return redirect('/login');

    }
}
