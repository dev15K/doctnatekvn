<?php

namespace App\Http\Controllers;

use App\Enums\RoleName;
use App\Enums\UserStatus;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $url_callback = $request->input('url_callback');
        if (Auth::check()) {
            return redirect(route('admin.home'));
        }
        return view('auth.login', compact('url_callback'));
    }

    public function handleLogin(Request $request)
    {
        try {
            $loginRequest = $request->input('login_request');
            $password = $request->input('password');
            $url_callback = $request->input('url_callback');

            $credentials = [
                'password' => $password,
            ];

            if (filter_var($loginRequest, FILTER_VALIDATE_EMAIL)) {
                $credentials['email'] = $loginRequest;
            } else {
                $credentials['phone'] = $loginRequest;
            }

            $user = User::where('email', $loginRequest)->orWhere('phone', $loginRequest)->first();
            if (!$user) {
                alert()->error('Account not found!');
                return redirect()->back();
            }

            if ($user->status == UserStatus::INACTIVE()) {
                alert()->error('User is inactive!');
                return redirect()->back();
            }

            if ($user->status == UserStatus::BLOCKED()) {
                alert()->error('User has been blocked!');
                return redirect()->back();
            }

            if ($user->status == UserStatus::DELETED()) {
                alert()->error('User has been deleted!');
                return redirect()->back();
            }

            $roleAdmin = Role::where('name', RoleName::ADMIN())->first();
            if (!$roleAdmin) {
                alert()->error('Role admin not found!');
                return redirect()->back();
            }

            $user_role = RoleUser::where('user_id', $user->id)->where('role_id', $roleAdmin->id)->first();
            if (!$user_role) {
                alert()->error('User is not permission!');
                return redirect()->back();
            }

            if (Auth::attempt($credentials)) {
                alert()->success('Login success!');
                if ($url_callback) {
                    return redirect($url_callback);
                }
                return redirect(route('admin.home'));
            }

            alert()->error('Login fail! Please check email or password');
            return redirect()->back();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', $e->getMessage());
        }
    }

    public function logout()
    {
        if (Auth::check()) {
            Auth::logout();
        }
        return redirect('/');
    }
}
