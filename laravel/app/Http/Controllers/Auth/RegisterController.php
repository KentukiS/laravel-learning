<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function save(AuthRequest $request){
        if(Auth::check()){
            return redirect(route('user.private'));
        }
        $validateFields = $request->validated();
        $validateFields['password'] = Hash::make($validateFields['password']);

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
