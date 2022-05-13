<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class PasswordResetController extends Controller
{
    public function userResetPassword(Request $request) {

        if(User::where('email', $request->email)->first()){
            
        }
        return response()->json(['status' => 422, 'errorTitle' => 'Email not found!', 'errorMessage' => 'Email does not exist in our records!' ]);
    }
}
