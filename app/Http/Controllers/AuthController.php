<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function login()
    {
        return view('login');
    }

    public function loginproses(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (auth()->user()->role == 'Admin') {
                return redirect('admin');
            } elseif (auth()->user()->role == 'Mitra') {
                return redirect('mitra');
            } elseif (auth()->user()->role == 'User') {
                return redirect('/');
            }
        } else {
            return back()->with('error', 'Username atau password salah');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function register()
    {
        return view('register');
    }

    public function registerproses(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required|confirmed:password_confirmation',
        ]);

        $user = User::create([
            'username' => $request->username,
            'name' => $request->username,
            'password' => bcrypt($request->password),
            'role' => 'User',
        ]);

        return redirect('login');
    }
}
