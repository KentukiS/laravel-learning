<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function save(Request $request){
        if(Auth::check()){
            return redirect(route('user.private'));
        }
        $validateFields = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            "email" => ['required', 'string', 'email', 'max:255', 'unique:users'],
            "password" => 'required',
        ]);

        if(User::where('email',$validateFields['email'])->exists()){
            return redirect(route('user.register'))->withErrors([
                'email' => 'Такой юзур уже существует'
            ]);
        }

        $user = User::create([
            'name' => $validateFields['name'],
            'email' => $validateFields['email'],
            'password' => Hash::make($validateFields['password']),
        ]);

        if($user){
            Auth::login($user);
            return redirect()->to(route('user.private'));
        }

        return redirect(route('user.login'))->withErrors([
            'formError' => 'User save error'
        ]);
    }
}
