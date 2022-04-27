<?php

namespace App\Http\Controllers\Auth\Login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //ログイン画面表示
    public function showLogin(){
        return view('auth.login_form');
    }

    //ログイン機能
    public function login(LoginRequest $request){

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('home');
        }

        return back()->withErrors([
            'login_error' => 'メールアドレスかパスワードが間違っています'
        ])->withInput();
    }

    //ログアウト
    public function logout(){
        Auth::logout();
        return redirect()->route('showLogin');
    }
}
