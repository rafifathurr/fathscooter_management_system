<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\users\User;

class UserController extends Controller
{

    public $successStatus = 200;

    public function login()
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $querydb = User::with('role')->where('email', request('email'))->first();
            return response()->json($querydb->toArray());
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }
}
