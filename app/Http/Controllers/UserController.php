<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function get_user_from_token() {
        $value = substr(Request::header('Authorization'), 7);
        $user = User::where('api_token', $value)->first();
        return $user;
    }

    public function get_token_from_login() {
        $email = Input::get('email');
        $password = Input::get('password');
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $user = User::where('email', $email)->first();
            return $user;
        }
    }
}
