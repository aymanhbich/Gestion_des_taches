<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestLogin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index()
    {
        return view("auth.login");
    }

    public function login(RequestLogin $request)
    {
        $credentials = $request->only(["email", "password"]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route("tasks.index"); // Changed to redirect()->route()
        }
        return back()->withInput()->with("error", "L'email ou le mot de passe est incorrect"); // Fixed method call
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect()->route("login"); // Changed to redirect()->route()
    }
}
