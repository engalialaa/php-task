<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Sale;
use App\Models\SaleDetails;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CartController extends Controller
{
    public function index()
    {
        return view('Admin/carts/index');
    }

    public function cartsData()
    {
        Carbon::setLocale('ar');
        $cart = Sale::where('is_end',1)
            ->where('status','=','new')
            ->orwhere('status','=','making')
            ->orwhere('status','=','delivry')
            ->latest()->get();
        return Datatables::of($cart)
            ->addColumn('action', function ($cart) {
                return '<button id="order_details" title="تفاصيل الطلب" style="background: none;border: 0px;" data-id="' . $cart->id . '"><i class="fa fa-eye text-success fs-1"></i></button>';
            })
            ->addColumn('delete', function ($cart) {
                return '<button data-bs-toggle="modal" data-bs-target="#delete_modal"  data-toggle="modal" title="حذف الطلب" style="background: none;border: 0px;" data-id="' . $cart->id . '" data-name ="' . $cart->first_name .' '. $cart->last_name . '"><i class="fa fa-trash text-danger fs-1"></i></button>';
            })
            ->addColumn('status', function ($cart) {
                if ($cart->status == 'new')
                return '
                <button   title="قبول الطلب" id="making_order" style="background: none;border: 0px;" data-id="' . $cart->id . '"><i class="fas fa-check-circle text-success fs-1"></i></button>
                <button   title="رفض الطلب" id="refusal_order" style="background: none;border: 0px;" data-id="' . $cart->id . '"><i class="fas fa-times-circle text-danger fs-1"></i></button>
                ';
                elseif($cart->status == 'making')
                    return '<button title="انهاء التحضير" id="delivry_order" style="background: none;border: 0px;" data-id="' . $cart->id . '"><i class="fas fa-praying-hands text-warning fs-1"> جارى التحضير</i></button>';
                elseif($cart->status == 'delivry')
                    return '<button title="انهاء التوصيل" id="ending_order" style="background: none;border: 0px;" data-id="' . $cart->id . '"><i class="fas fa-truck text-primary fs-1"> جارى التوصيل</i></button>';
            })
            ->addColumn('pay_type', function ($cart){
                if ($cart->pay_type == 'online')
                return '<button    title="اونلاين" style="background: none;border: 0px;"><i class="fab fa-cc-visa text-primary fs-1"></i></button>';
                else
                    return '<button    title="عند الاستلام" style="background: none;border: 0px;"><i class="fas fa-money-bill-alt text-success fs-1"></i></button>';

            })
            ->addColumn('is_paid', function ($cart){
                if ($cart->is_paid == 'unpaid')
                return '<button    title="غير مدفوع" style="background: none;border: 0px;"><i class="text-danger fs-1">غير مدفوع</i></button>';
                else
                    return '<button    title="مدفوع" style="background: none;border: 0px;"><i class="text-success fs-1">مدفوع</i></button>';

            })
            ->editColumn('id', function ($cart) {
                return $cart->id."#";
            })
            ->editColumn('total', function ($cart) {
                return $cart->total." ج.م";
            })
            ->editColumn('user_id', function ($cart) {
                return $cart->first_name." ".$cart->last_name;
            })
            ->editColumn('created_at', function ($cart) {
                return '' . $cart->created_at;
            })
            ->escapeColumns([])
            ->make(true);
    }

    public function delete(Request $request)
    {
        $cart = Sale::where('id', $request->id)->first();
        $cart->delete();
        return response()->json(
            [
                'success' => true,
                'message' => 'Data deleted successfully'
            ]);
    }

    public function details($id)
    {
        $sale_details = SaleDetails::where('sale_id',$id)->latest()->get();

        $returnHTML = view('Admin/carts/row',['sale_details'=> $sale_details])->render();

        return response()->json( array('success' => true, 'html'=>$returnHTML) );
    }

    public function making_order(Request $request)
    {
        $sale = Sale::where('id', $request->id)->first();

        $sale->update(['status'=>'making']);
        return response()->json(
            [
                'success' => true,
                'message' => 'Data changed successfully'
            ]);
    }

    public function delivry_order(Request $request)
    {
        $sale = Sale::where('id', $request->id)->first();

        $sale->update(['status'=>'delivry']);
        return response()->json(
            [
                'success' => true,
                'message' => 'Data changed successfully'
            ]);
    }

    public function ending_order(Request $request)
    {
        $sale = Sale::where('id', $request->id)->first();

        $sale->update(['status'=>'confirm']);
        return response()->json(
            [
                'success' => true,
                'message' => 'Data changed successfully'
            ]);
    }

    public function refusal_order(Request $request)
    {
        $sale = Sale::where('id', $request->id)->first();

        $sale->update(['status'=>'refusal']);
        return response()->json(
            [
                'success' => true,
                'message' => 'Data changed successfully'
            ]);
    }

     //Confirm order
    public function confirmOrder()
    {
        return view('Admin/carts/confirm_order');
    }

    public function Confirm_cartsData()
    {
        Carbon::setLocale('ar');
        $cart = Sale::where('is_end',1)
            ->where('status','confirm')
            ->orwhere('status','=','refusal')
            ->latest()->get();
        return Datatables::of($cart)
            ->addColumn('action', function ($cart) {
                return '<button data-bs-toggle="modal" data-bs-target="#edit_modal"  data-toggle="modal" title="تفاصيل الطلب" style="background: none;border: 0px;" data-id="' . $cart->id . '"><i class="fa fa-eye text-success fs-1"></i></button>';
            })
            ->addColumn('delete', function ($cart) {
                return '<button data-bs-toggle="modal" data-bs-target="#delete_modal"  data-toggle="modal" title="حذف الطلب" style="background: none;border: 0px;" data-id="' . $cart->id . '" data-name ="' . $cart->first_name .' '. $cart->last_name . '"><i class="fa fa-trash text-danger fs-1"></i></button>';
            })
            ->addColumn('pay_type', function ($cart){
                if ($cart->pay_type == 'online')
                    return '<button    title="اونلاين" style="background: none;border: 0px;"><i class="fab fa-cc-visa text-primary fs-1"></i></button>';
                else
                    return '<button    title="عند الاستلام" style="background: none;border: 0px;"><i class="fas fa-money-bill-alt text-success fs-1"></i></button>';

            })
            ->addColumn('status', function ($cart) {
                if($cart->status == 'confirm')
                    return '<button title="تم التسليم" style="background: none;border: 0px;" data-id="' . $cart->id . '"><i class="fas fa-handshake text-success fs-1"> تم التسليم </i></button>';
                else
                    return '<button title="طلب مرفوض" id="ending_order" style="background: none;border: 0px;" data-id="' . $cart->id . '"><i class="fas fa-times-circle text-danger fs-1"> مرفوض</i></button>';
            })
            ->editColumn('id', function ($cart) {
                return $cart->id."#";
            })
            ->editColumn('total', function ($cart) {
                return $cart->total." ج.م";
            })
            ->editColumn('user_id', function ($cart) {
                return $cart->first_name." ".$cart->last_name;
            })
            ->editColumn('created_at', function ($cart) {
                return '' . $cart->created_at;
            })
            ->escapeColumns([])
            ->make(true);
    }
}
