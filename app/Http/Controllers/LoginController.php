<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{

    public function register()
    {
        return view('register');
    }
      
    public function register_action(Request $request)
    {
        $request->validate([
            'npm' => 'required|unique:users',
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        $user = new User([
            'npm' => $request->input('npm'),
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role' => 'mahasiswa', // Set the default role to 'mahasiswa'
        ]);
        $user->save();

        // Redirect the user to the login view
        return redirect()->route('login')->with('success', 'Registration successful, please login.');
    }
    
    public function index(){
        return view('login');
    }
    
    public function login_action(Request $request)
    {
        request()->validate(
        [
            'email' => 'required',
            'password' => 'required',
        ]);
    
        $credentials = $request->only('email','password');
            if (Auth::attempt($credentials)){
            $user = Auth::user();
            if ($user->role == 'admin'){
                return redirect()->intended('admin/home');
            }elseif ($user->role == 'mahasiswa'){
                return redirect()->intended('home');
            }return redirect()->intended('/');
        }return redirect('/')->withInput()->withErrors(['login_gagal' => 'Email sama Paswordnya salah cok']);
    }

    
    public function logout(Request $request){
        $request->session()->flush();
        Auth::logout();
        return Redirect('/');
    }
}


