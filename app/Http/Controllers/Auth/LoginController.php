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
                $request->session()->regenerate();
                $user = User::where('email', $request->email)->first();
                $token = $user->createToken('auth_token')->plainTextToken;
                return response()->json([
                    'access_token' => $token,
                    'token_type' => 'Bearer',
                    'user' => $user
                ]);
            }
            return response()->json(['status' => 422, 'errorTitle' => 'Password Error!', 'errorMessage' => 'Password entered is incorrect!' ]);
        }
        return response()->json(['status' => 422, 'errorTitle' => 'Email not found!', 'errorMessage' => 'Email does not exist in our records!' ]);
    }

    public function index() {
        return response()->json(\App\Models\Roles::all());
    }
}

