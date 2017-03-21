<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;


class UserController extends Controller
{
    public function list_users() {
        $users = User::all('id', 'name', 'email', 'is_admin');
        $currentUser = Auth::user();
        if($currentUser->is_Admin == 1) {
            return view('users.manage', compact('users'));
        }
        else {
            Session::flash('message', "You are not authorised to view this page");
            return redirect('/');
        }
    }

    public function create() {
        $currentUser = Auth::user();
        if($currentUser->is_Admin == 1) {
            return view('users.create');
        }
        else {
            Session::flash('message', "You are not authorised to view this page");
            return redirect('/');
        }
    }

    public function edit($id) {
        $users = User::where('id', $id)->select('id', 'name', 'email', 'is_admin')->first();
        $currentUser = Auth::user();
        if($currentUser->is_Admin == 1) {
            return view('users.edit', compact('users'));
        }
        else {
            Session::flash('message', "You are not authorised to view this page");
            return redirect('/');
        }
    }

    public function save() {
        $id = Input::get('id');
        $password = Input::get('password');
        $password2 = Input::get('password2');
        $name = Input::get('name');
        $email = Input::get('email');
        $admin = Input::get('admin');
        $api_token = bin2hex(openssl_random_pseudo_bytes(16));

        (isset($admin)) ? $admin = 1 : $admin = 0;

        if (isset($id)) {
            //Edit existing
            if (isset($password) && !empty($password)) {
                //update password
                if ($password == $password2) {
                    //Passwords match, continue
                    if(User::where('id', $id)
                        ->update(
                            ['name' => $name,
                             'email' => $email,
                             'is_admin' => $admin,
                             'password' => Hash::make($password)]
                        )) {
                        Session::flash('message', "User updated");
                        return Redirect::back();
                    }
                    else {
                        Session::flash('message', "Something went wrong");
                        return Redirect::back();
                    }
                }
                else {
                    //No match
                    Session::flash('message', "Passwords do not match");
                    return Redirect::back();
                }
            }
            else {
                //No password update required
                if(User::where('id', $id)
                    ->update(
                        ['name' => $name,
                         'is_admin' => $admin,
                         'email' => $email]
                    )){
                    Session::flash('message', "User updated");
                    return Redirect::back();
                }
                else {
                    Session::flash('message', "Something went wrong");
                    return Redirect::back();
                }
            }
        }
        else {
            //Add new
            if (isset($password) && !empty($password)) {
                //update password
                if ($password == $password2) {
                    //Passwords match, continue
                    if(User::insert(
                            ['name' => $name,
                                'email' => $email,
                                'password' => Hash::make($password),
                                'is_admin' => $admin,
                                'api_token' => $api_token]
                        )) {
                        Session::flash('message', "User created");
                        return Redirect::back();
                    }
                    else {
                        Session::flash('message', "Something went wrong");
                        return Redirect::back();
                    }
                }
                else {
                    //No match
                    Session::flash('message', "Passwords do not match");
                    return Redirect::back();
                }
            }
        }
    }

    public function delete($id) {
        if(User::where('id', $id)->delete()) {
            Session::flash('message', "User deleted");
            return Redirect::back();
        }
        else {
            Session::flash('message', "Something went wrong");
            return Redirect::back();
        }
    }

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
        else {
            return Response::json(['error' => 'Unauthorised'], 403);
        }
    }
}
