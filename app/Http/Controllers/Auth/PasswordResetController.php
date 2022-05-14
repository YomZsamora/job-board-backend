<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\PasswordReset;
use Illuminate\Support\Facades\Mail;

class PasswordResetController extends Controller
{
    public function userResetPassword(Request $request) {

        if(User::where('email', $request->email)->first()){
            Mail::to('samora.yommie@moringaschool.com')->send(new PasswordReset());
            return response()->json(['status' => 200, 'errorTitle' => 'Email Sent!', 'errorMessage' => 'You will receive an email with instructions for resetting your password. Click on the link to reset your password!' ]);
        }
        return response()->json(['status' => 422, 'errorTitle' => 'Email not found!', 'errorMessage' => 'Email does not exist in our records!' ]);
    }
}
