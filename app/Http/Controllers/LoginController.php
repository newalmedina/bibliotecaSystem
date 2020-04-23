<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view("login.login");
    }

    public function login()
    {
        $credentials = $this->validate(request(), [
            $this->username() => "required|string",
            "password" => "required|string",
        ]);

        if (!!Auth::attempt($credentials)) {
            return redirect()->route("inicio");
        }
        return back()
            ->withErrors([$this->username()  => trans("auth.failed")])
            ->withInput(request([$this->username()]));
    }
    public function logout()
    {
        Auth::logout();
        return redirect("/");
    }
    public function username()
    {
        return "correo";
    }
}
