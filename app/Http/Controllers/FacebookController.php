<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Socialite;
use PDO;

class FacebookController extends Controller
{
    function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    function handleFacebookCallBack()
    {
        $user = Socialite::driver('facebook')->user();

        $findUser = User::where('facebook_id', $user->id)->first();

        if (!is_null($findUser)) {
            if ($findUser->role == 'admin') {
                Auth::guard('admin')->login($findUser);
            } else {
                return redirect()->route('admin.login')->with('error', 'Unautorize User. Access denied');
            }
        } else {
            $create = new User();

            $create->name = $user->name;
            $create->email = $user->id . '@facebook.com';
            $create->facebook_id = $user->id;
            $create->password = Hash::make(123456);
            $create->role = 'admin';
            $create->save();

            if ($create->role == 'admin') {
                Auth::guard('admin')->login($create);
            } else {
                return redirect()->route('admin.login')->with('error', 'Unautorize User. Access denied');
            }
        }

        return redirect()->route('admin.dashboard');
    }
}
