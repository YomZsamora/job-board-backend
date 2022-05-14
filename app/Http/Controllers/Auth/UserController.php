<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function getUserDetails() {
        $user = User::where('active', 1)->first();
        return response()->json(['status' => 200, 'user' => $user]);
    }
}
