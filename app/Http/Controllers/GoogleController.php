<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Socialite;



class GoogleController extends Controller
{
    function redirectToGoogle(Request $request)
    {
        return Socialite::driver('google')->redirect();
    }
    public function handleGoogleCallBack(Request $request)
    {
        $user = Socialite::driver('google')->user();

        $findUser = User::where('google_id', $user->id)->first();


        if (!is_null($findUser)) {
            if ($findUser->role == 'admin') {
                Auth::guard('admin')->login($findUser);
            } else {
                return redirect()->route('admin.login')->with('error', 'Unautorize User. Access denied');
            }
        } else {
            $create = new User();

            $create->name = $user->name;
            $create->email = $user->email;
            $create->google_id = $user->id;
            $create->password = Hash::make('123456');
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
