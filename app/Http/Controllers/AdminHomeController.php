<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AdminHomeController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function showProfile()
    {
        return view('admin.profile');
    }

    public function updateProfile(Request $request)
    {
        try {
            $name = $request->input('name');
            $email = $request->input('email');
            $phone = $request->input('phone');
            $address = $request->input('address');
            $avt = Auth::user()->avatar;

            if ($request->hasFile('avatar')) {
                $item = $request->file('avatar');
                $itemPath = $item->store('avatars', 'public');
                $avt = asset('storage/' . $itemPath);
            }

            $user = User::find(Auth::user()->id);

            if ($user->email != $email) {

                $isEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
                if (!$isEmail) {
                    return back()->with('error', 'Email is not valid!');
                }

                $isValid = User::checkEmail($email);
                if (!$isValid) {
                    return back()->with('error', 'Email already exists!');
                }
                $user->email = $email;
            }

            if ($user->phone != $phone) {
                $isValid = User::checkPhone($phone);
                if (!$isValid) {
                    return back()->with('error', 'Phone already exists!');
                }
                $user->phone = $phone;
            }

            $user->name = $name;
            $user->address = $address;
            $user->avatar = $avt;
            $user->save();

            return back()->with('success', 'Update profile successfully!');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', $e->getMessage());
        }
    }

    public function changePassword(Request $request)
    {
        try {
            $password = $request->input('password');
            $password_confirm = $request->input('newpassword');
            $new_password_confirm = $request->input('renewpassword');

            $user = User::find(Auth::user()->id);

            if (!Hash::check($password, $user->password)) {
                return back()->with('error', 'Password is not correct!');
            }

            if ($new_password_confirm != $password_confirm) {
                return back()->with('error', 'Password does not match!');
            }

            if (strlen($password_confirm) < 5) {
                return back()->with('error', 'Password must be at least 5 characters!');
            }

            $passwordHash = Hash::make($password_confirm);
            $user->password = $passwordHash;
            $user->save();

            return back()->with('success', 'Change password successfully!');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', $e->getMessage());
        }
    }
}
