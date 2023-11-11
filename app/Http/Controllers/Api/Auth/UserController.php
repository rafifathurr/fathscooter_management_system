<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Support\Facades\Validator;
use App\Helpers\UserLog;
use Illuminate\Http\Request;
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
            $success['id'] =  $querydb->id;
            $success['name'] =  $querydb->name;
            $success['email'] =  $querydb->email;
            $success['username'] =  $querydb->username;
            $success['phone'] =  $querydb->phone;
            $success['token'] =  $querydb->remember_token;
            $success['role_id'] =  $querydb->role_id;
            $success['roles'] =  $querydb->role->role;
            $success['address'] =  $querydb->address;
            return response()->json($success);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }
}
