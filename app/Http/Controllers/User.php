<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class User extends Controller
{
    

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {
            
            if(auth()->user()->isNominee()) {
                return "Hello NOMINEE";
             }
             return "HELLO OTHERS";
            // return redirect()->intended('dashboard');
        }
        return "Hi Khos";
    }
}
1