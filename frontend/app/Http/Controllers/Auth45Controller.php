<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Auth45Controller extends Controller
{
    // views //
    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    // process //
    public function registerP(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ]);

        $login = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'foto' => $request->foto,
        ]);

        if ($request->hasFile('foto')) {
            $request->file('foto')->move('img/', $request->file('foto')->getClientOriginalName());
            $login->foto = $request->file('foto')->getClientOriginalName();
            $login->save();
            return redirect('/login45')->with('success', 'register success');
        }

        return redirect('/register45')->with('error', 'register error');
    }

    public function loginP(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        $login = Auth::attempt(['email' => $request->email, 'password' => $request->password]);

        if ($login) {
            if (Auth::user()->is_aktif) {
                return redirect('/');
            }
            Auth::logout();
            return redirect('/login45')->with('error', 'Belum di approve');
        }
        return redirect('/login45')->with('error', 'Email or password wrong');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login45')->with('success', 'Logout success');
    }
}
