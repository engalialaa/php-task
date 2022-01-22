<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Department;
use App\Models\Service;
use App\Models\Contact;
use App\Models\User;
use App\Models\Reservation;
use Illuminate\Http\Request;

class HomeController extends Controller
{
//    public function index()
//    {
//        //Admins Report
//        $admins =  Admin::count();
//
//        //User Report
//        $UserNew =  User::where('approved_status','new')->where('user_type','provider')->count();
//        $UserAccepted =  User::where('approved_status','accepted')->where('user_type','provider')->count();
//        $client =  User::where('user_type','client')->where('is_blocked','not_blocked')->count();
//
//        //Departments Report
//        $departments_yes =  Department::where('is_shown','yes')->count();
//        $departments_no =  Department::where('is_shown','no')->count();
//
//        //Reservations Report
//        $Reservations_all_new =Reservation::where('status','new')->latest()->get();
//        $Reservations_all_confirmed =Reservation::where('status','confirmed')->latest()->get();
//        $Reservations_new =Reservation::where('status','new')->count();
//        $Reservations_confirmed =Reservation::where('status','confirmed')->count();
//        $Reservations_confirmed_year =Reservation::where('status','confirmed')->whereyear('date',date('Y'))->count();
//        $Reservations_confirmed_month =Reservation::where('status','confirmed')->wheremonth('date',date('m'))->count();
//        $Reservations_confirmed_day =Reservation::where('status','confirmed')->whereday('date',date('j'))->count();
//
//
//        //Services Report
//        $services_yes =  Service::where('is_shown','yes')->count();
//        $services_no =  Service::where('is_shown','no')->count();
//
//        //Contacts Report
//        $contacts_read =  Contact::where('is_read','read')->count();
//        $contacts_unread =  Contact::where('is_read','unread')->count();
//
//        return view('Admin/index',compact('admins','departments_no','contacts_unread','contacts_read',
//            'Reservations_confirmed','Reservations_new','departments_yes','services_no','services_yes','contacts_read',
//            'UserNew','UserAccepted','client','Reservations_confirmed_year','Reservations_confirmed_month',
//            'Reservations_confirmed_day','Reservations_all_new','Reservations_all_confirmed'));
//    }

        public function index()
        {
            return view('Admin/index');
        }
}
