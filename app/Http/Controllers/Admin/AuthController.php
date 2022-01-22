<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request){
        $valedator =Validator::make($request->all(),[
            'email'=> [ 'unique:admins'],
        ]);
        if ($valedator->fails()){
            $rememberme = request('rememberme') == 1?true:false;
            if (admin()->attempt(['email' => request('email'), 'password' => request('password')], $rememberme)) {
                $notification=array(
                    'message' => 'تم تسجيل الدخول بنجاح',
                    'alert-type' => 'success'
                );
                return redirect('admin/home')->with($notification);
            } else {
                $notification=array(
                    'message' => 'يوجد خطأ فى كلمة المرور',
                    'alert-type' => 'error'
                );
                return back()->with($notification);
            }
        }
        else{
            $notification=array(
                'message' => 'هذا البريد الالكترونى غير موجود',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }
    }//end fun

    public function logout(){
        admin()->logout();
        $notification=array(
            'message' => 'تم تسجيل الخروج',
            'alert-type' => 'info'
        );
        return redirect('admin/login')->with($notification);
    }
}
