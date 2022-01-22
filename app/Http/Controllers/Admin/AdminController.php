<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdmin;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class AdminController extends Controller
{
    public function index()
    {
        return view('Admin/Admin/index');
    }

    ################ Show Admin #################
    public function adminData()
    {
        $admin = Admin::latest()->get();
        return Datatables::of($admin)
            ->addColumn('action', function ($admin) {
                return '
                            <button data-bs-toggle="modal" data-bs-target="#edit_modal" class="btn btn-icon btn-bg-light btn-primary btn-sm me-1" data-toggle="modal" style="border-radius: 50% !important"
                                    data-id="' . $admin->id . '" data-name="' . $admin->name . '" data-email="' . $admin->email . '">
                            <span class="svg-icon svg-icon-3">
                                <span class="svg-icon svg-icon-3">
                                    <i class="fa fa-edit"></i>
                                </span>
                            </span>
                            </button>
                            <button data-bs-toggle="modal" data-bs-target="#delete_modal" class="btn btn-icon btn-bg-light btn-danger btn-sm me-1" data-toggle="modal" style="border-radius: 50% !important"
                                    data-id="' . $admin->id . '" data-title="' . $admin->name . '">
                            <span class="svg-icon svg-icon-3">
                                <span class="svg-icon svg-icon-3">
                                    <i class="fa fa-trash"></i>
                                </span>
                            </span>
                            </button>
                       ';
            })
            ->make(true);
    }
    ###############################################


    ################ Add Admin #################
    public function add(StoreAdmin $request)
    {
        $admin = new Admin();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password = Hash::make($request->password);
        $admin->save();
        return response()->json(
            [
                'success' => true,
                'message' => 'Data added successfully'
            ]);
    }
    ###############################################


    ################ Edit Admin #################
    public function edit(StoreAdmin $request)
    {
        $admin = Admin::where('id', $request->id)->first();
        $admin->name = $request->name;
        $admin->email = $request->email;
        if ($request->password != null)
            $admin->password = Hash::make($request->password);
        $admin->save();
        return response()->json(
            [
                'success' => true,
                'message' => 'Data updated successfully'
            ]);
    }
    ###############################################


    ################ Delete Admin #################
    public function delete(Request $request)
    {
        $admin = Admin::where('id', $request->id)->first();
        if ($admin == auth()->guard('admin')->user()) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'failed',
                ]);
        } else {
            $admin->delete();
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Data deleted successfully'
                ]);
        }
    }

    ###############################################


    public function save_profile(Request $request)
    {
        if (auth()->guard('admin')->user()->email != $request->email) {
            $valedator = Validator::make($request->all(), [
                'email' => ['unique:admins'],
            ]);
            if ($valedator->fails()) {
                return back()->with(notification('هذا البريد الإلكترونى موجود مسبقا', 'warning'));
            }
        }
        $update = Admin::find(auth()->guard('admin')->user()->id);
        $update->name = $request->name;
        $update->email = $request->email;
        if (isset($request->password)) {
            $update->password = Hash::make($request->password);
        }
        $update->save();
        toastr()->success('تم التعديل');
        return redirect()->back();
    }//end fun

    public function my_profile()
    {
        return view('Admin/profile/index');
    }//end fun
}
