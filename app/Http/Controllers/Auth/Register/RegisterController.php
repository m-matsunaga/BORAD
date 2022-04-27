<?php

namespace App\Http\Controllers\Auth\Register;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\User;

class RegisterController extends Controller
{
    public function createForm(){
        return view('auth.register');
    }

    public function createDone(){
        return view('auth.added');
    }

   //登録処理
   protected function register(RegisterRequest $request){

        $username = $request->username;
        $email = $request->email;
        $password = $request->password;
        // \DB::table('users')->insert([
        //     'username' => $username,
        //     'email' => $email,
        //     'password' => bcrypt($password),
        // ]);
        return redirect('/register/confirm')
        ->with([
            'username' => $username,
            'email' => $email,
            'password' => $password
        ]);
    }

    public function RegisterConfirm(){
        return view('auth.register_confirm');
    }

   protected function registerExecute(Request $request){

        $username = $request->username;
        $email = $request->email;
        $password = $request->password;
        \DB::table('users')->insert([
            'username' => $username,
            'email' => $email,
            'password' => bcrypt($password),
        ]);
        return redirect('/added');
}
}
