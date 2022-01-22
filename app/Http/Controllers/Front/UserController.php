<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserSign;
use App\User;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    public function register(UserSign $request)
    {
        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = bcrypt($request->password);
        $user->save();

        auth()->login($user);
        toastr()->success('You are logged in successfully');
        return redirect()->route('Front.Home');

    }

    public function login(Request $request)
    {
        $valedator =Validator::make($request->all(),[
            'email'=> ['unique:users'],
        ]);
        if ($valedator->fails()){
            $rememberme = request('rememberme') == 1?true:false;
            if (auth()->attempt(['email' => request('email'), 'password' => request('password')], $rememberme))
                {
                    toastr()->success('You are logged in successfully');
                    return redirect()->route('Front.Home');
                }
                else
                {
                    toastr()->error('Please enter the valid email and password');
                    return redirect()->route('user.login');
                }
        }
        else{
            toastr()->error('Please enter the valid email and password');
            return back();
        }
    }//end fun

    public function logout()
    {
        auth()->logout();
        toastr()->success('Signed out');
        return redirect()->route('Front.Home');
    }

}
