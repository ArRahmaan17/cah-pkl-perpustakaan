<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login', ['title' => 'Login']);
    }

    public function cek(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('username', $request->username)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            session([
                'user_id' => $user->id_user,
                'username' => $user->username,
                'role' => $user->role,
                'login' => true,
            ]);

            return redirect()->route('dashboard');
        } else {
            return redirect()->route('login')->with('notif', '<div class="alert alert-danger">Username atau Password salah</div>');
        }
    }

    public function logout()
    {
        session()->flush(); 
        return redirect()->route('beranda'); 
    }
}
