<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request){
        if(Auth::check()){
            return redirect()->intended('user.private');
        }

        $formFields = $request->only(['email','password']);
        if(Auth::attempt($formFields)){
            return redirect()->intended('user.private');
        }

        return redirect(route('user.login'))->withErrors([
            'email' => 'Не удалось авторизироваться'
        ]);
    }
}
