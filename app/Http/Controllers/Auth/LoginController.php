<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function authenticate(Request $request) {

        if(User::where('email', $request->email)->first()){
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $user = User::where('email', $request->email)->first();
                $request->session()->regenerate();
                $request->session()->put('key',$user->remember_token);
                $sessionKey = $request->session()->get('key');
                $token = $user->createToken('auth_token')->plainTextToken;
                return response()->json([
                    'access_token' => $token,
                    'token_type' => 'Bearer',
                    'session_key' => $sessionKey,
                    'user_data' => $user
                ]);
            }
            return response()->json(['status' => 422, 'errorMessage' => 'Password entered is incorrect!' ]);
        }
        return response()->json(['status' => 422, 'errorMessage' => 'Email does not exist in our records!' ]);
    }
}

